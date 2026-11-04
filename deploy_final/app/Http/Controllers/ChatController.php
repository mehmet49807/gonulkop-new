<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * List conversations and eligible recipients.
     */
    public function index(Request $request): View|JsonResponse
    {
        $member = $request->user();

        $recipients = User::query()
            ->whereKeyNot($member->getKey())
            ->where('gender', $member->gender?->opposite()?->value)
            ->where('profile_visibility', '!=', 'private')
            ->orderBy('name')
            ->get();

        $conversations = $this->conversations($member);

        $trialExpired = $member->hasExpiredTrial();
        $premiumRequired = $trialExpired && ! $member->is_premium;

        if ($request->expectsJson()) {
            return response()->json([
                'data' => [
                    'conversations' => $conversations,
                    'recipients' => $recipients,
                    'trial_expired' => $trialExpired,
                    'premium_required' => $premiumRequired,
                ],
            ]);
        }

        return view('messages.index', [
            'conversations' => $conversations,
            'recipients' => $recipients,
            'trialExpired' => $trialExpired,
            'premiumRequired' => $premiumRequired,
        ]);
    }

    /**
     * Display a conversation with a member.
     */
    public function show(Request $request, User $user): View|JsonResponse
    {
        $member = $request->user();
        Gate::forUser($member)->authorize('view', $user);

        $messages = Message::query()
            ->where(fn ($query) => $query
                ->where(fn ($query) => $query
                    ->where('sender_id', $member->getKey())
                    ->where('recipient_id', $user->getKey()))
                ->orWhere(fn ($query) => $query
                    ->where('sender_id', $user->getKey())
                    ->where('recipient_id', $member->getKey())))
            ->with([
                'sender:id,name,gender,profile_photo_path',
                'recipient:id,name,gender,profile_photo_path',
            ])
            ->oldest('id')
            ->get();

        Message::query()
            ->where('sender_id', $user->getKey())
            ->where('recipient_id', $member->getKey())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $trialExpired = $member->hasExpiredTrial();
        $premiumRequired = $trialExpired && ! $member->is_premium;

        if ($request->expectsJson()) {
            return response()->json([
                'data' => [
                    'active_user' => $user,
                    'messages' => $messages,
                    'trial_expired' => $trialExpired,
                    'premium_required' => $premiumRequired,
                ],
                'active_user' => $user,
                'messages' => $messages,
                'trial_expired' => $trialExpired,
                'premium_required' => $premiumRequired,
            ]);
        }

        return view('messages.show', [
            'conversations' => $this->conversations($member),
            'activeUser' => $user,
            'messages' => $messages,
            'trialExpired' => $trialExpired,
            'premiumRequired' => $premiumRequired,
        ]);
    }

    /**
     * Build the member's conversation summaries.
     */
    private function conversations(User $member): Collection
    {
        $messages = Message::query()
            ->where(fn ($query) => $query
                ->where('sender_id', $member->getKey())
                ->orWhere('recipient_id', $member->getKey()))
            ->with([
                'sender:id,name,gender,profile_photo_path',
                'recipient:id,name,gender,profile_photo_path',
            ])
            ->latest('id')
            ->get();

        return $messages
            ->groupBy(fn (Message $message) => $message->sender_id === $member->getKey()
                ? $message->recipient_id
                : $message->sender_id)
            ->map(function ($conversationMessages) use ($member): array {
                $lastMessage = $conversationMessages->first();
                $counterpart = $lastMessage->sender_id === $member->getKey()
                    ? $lastMessage->recipient
                    : $lastMessage->sender;

                if ($counterpart?->gender !== $member->gender?->opposite()) {
                    return [];
                }

                return [
                    'user' => $counterpart,
                    'last_message' => $lastMessage,
                    'updated_at' => $lastMessage->updated_at,
                    'unread_count' => $conversationMessages->where('recipient_id', $member->getKey())
                        ->whereNull('read_at')
                        ->count(),
                ];
            })
            ->filter()
            ->sortByDesc('updated_at')
            ->values();
    }

    /**
     * Send a message to an opposite-gender member.
     */
    public function store(StoreMessageRequest $request, User $user): JsonResponse|RedirectResponse
    {
        $member = $request->user();
        Gate::forUser($member)->authorize('create', [Message::class, $user]);

        if ($member->hasExpiredTrial() && ! $member->is_premium) {
            return response()->json([
                'error' => 'premium_required',
                'premium_required' => true,
                'message' => 'A premium membership is required to send messages.',
            ], 403);
        }

        $data = $request->safe()->except('attachment');

        if ($request->hasFile('attachment')) {
            $data['attachment_path'] = $request->file('attachment')->store('message-attachments', 'public');
        }

        $message = Message::create([
            ...$data,
            'sender_id' => $member->getKey(),
            'recipient_id' => $user->getKey(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
            ], 201);
        }

        return redirect()
            ->route('messages.show', $user)
            ->with('status', 'Your message was sent.');
    }
}
