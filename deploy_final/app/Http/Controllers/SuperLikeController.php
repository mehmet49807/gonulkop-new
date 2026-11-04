<?php

namespace App\Http\Controllers;

use App\Models\SuperLike;
use App\Models\User;
use Illuminate\Http\Request;

class SuperLikeController extends Controller
{
    public static function dailyLimit(): int
    {
        return 30; // Günlük 30 süper beğeni
    }

    public static function hasReachedLimit(User $user): bool
    {
        return SuperLike::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count() >= self::dailyLimit();
    }

    public static function getRemaining(User $user): int
    {
        return max(0, self::dailyLimit() - SuperLike::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count());
    }

    public function store(Request $request, User $user)
    {
        $member = $request->user();

        // Kendi profiline süper beğeni yapılamaz
        if ($member->getKey() === $user->getKey()) {
            return response()->json(['error' => 'Kendi profilinize süper beğenemezsiniz.'], 403);
        }

        // Zaten süper beğenilmiş mi?
        if (SuperLike::where('user_id', $member->getKey())
            ->where('liked_user_id', $user->getKey())
            ->exists()) {
            return response()->json(['error' => 'Bu kişiyi zaten süper beğendiniz.'], 403);
        }

        // Günlük limit kontrolü
        if (self::hasReachedLimit($member)) {
            return response()->json([
                'error' => 'Günlük süper beğeni limitiniz doldu (30 adet).',
                'remaining' => 0,
            ], 403);
        }

        // Süper beğeni kaydı
        SuperLike::create([
            'user_id' => $member->getKey(),
            'liked_user_id' => $user->getKey(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Süper beğeni gönderildi!',
            'remaining' => self::getRemaining($member),
        ]);
    }

    public function count(Request $request)
    {
        $member = $request->user();

        return response()->json([
            'remaining' => self::getRemaining($member),
            'limit' => self::dailyLimit(),
            'used_today' => SuperLike::where('user_id', $member->getKey())
                ->whereDate('created_at', today())
                ->count(),
        ]);
    }
}
