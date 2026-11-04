<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Message;
use App\Models\Post;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display the member's settings.
     */
    public function edit(Request $request): View
    {
        return view('settings.edit', [
            'settings' => $this->settingsPayload($request->user()),
        ]);
    }

    /**
     * Update notification and privacy preferences.
     */
    public function update(SettingsUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated())->save();

        return redirect()
            ->route('settings.edit')
            ->with('status', 'Your settings were updated.');
    }

    /**
     * Change the member's password.
     */
    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => $request->validated('password'),
        ]);

        return redirect()
            ->route('settings.edit')
            ->with('status', 'Your password was changed.');
    }

    /**
     * Delete the member's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
        ]);

        $member = $request->user();
        $filePaths = $this->memberFilePaths($member);

        Auth::logout();

        DB::transaction(fn () => $member->delete());
        Storage::disk('public')->delete($filePaths);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Collect the member's uploaded files before account deletion.
     *
     * @return list<string>
     */
    private function memberFilePaths(User $member): array
    {
        $postImages = Post::query()
            ->where('user_id', $member->getKey())
            ->whereNotNull('image_path')
            ->pluck('image_path');
        $storyImages = Story::query()
            ->where('user_id', $member->getKey())
            ->whereNotNull('image_path')
            ->pluck('image_path');
        $messageAttachments = Message::query()
            ->where(fn ($query) => $query
                ->where('sender_id', $member->getKey())
                ->orWhere('recipient_id', $member->getKey()))
            ->whereNotNull('attachment_path')
            ->pluck('attachment_path');

        return collect([$member->profile_photo_path])
            ->merge($postImages)
            ->merge($storyImages)
            ->merge($messageAttachments)
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /**
     * Build the editable settings payload.
     *
     * @return array<string, bool|string>
     */
    private function settingsPayload(User $member): array
    {
        return [
            'email_notifications' => $member->email_notifications,
            'push_notifications' => $member->push_notifications,
            'new_match_notifications' => $member->new_match_notifications,
            'message_notifications' => $member->message_notifications,
            'profile_visibility' => $member->profile_visibility,
            'show_online' => $member->show_online,
            'show_location' => $member->show_location,
        ];
    }
}
