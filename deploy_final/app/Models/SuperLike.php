<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuperLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'liked_user_id'];

    protected static function booted(): void
    {
        static::creating(function (self $superLike): void {
            // Zaten süper beğenilmiş mi kontrolü
            $exists = self::where('user_id', $superLike->user_id)
                ->where('liked_user_id', $superLike->liked_user_id)
                ->exists();

            if ($exists) {
                return false;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'liked_user_id');
    }

    public static function dailyLimit(): int
    {
        return 30;
    }

    public static function hasReachedLimit(User $user): bool
    {
        return self::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count() >= self::dailyLimit();
    }

    public static function getRemaining(User $user): int
    {
        return max(0, self::dailyLimit() - self::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count());
    }
}
