<?php

namespace App\Models;

use App\Gender;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'name',
    'email',
    'password',
    'gender',
    'username',
    'full_name',
    'phone',
    'bio',
    'city',
    'birth_date',
    'profile_photo_path',
    'email_notifications',
    'push_notifications',
    'new_match_notifications',
    'message_notifications',
    'profile_visibility',
    'show_online',
    'show_location',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The number of days a male member receives access to the feed.
     */
    public const TRIAL_DAYS = 3;

    /**
     * Profile attributes that are only exposed to the owner or an administrator.
     */
    public const PRIVATE_PROFILE_ATTRIBUTES = [
        'email',
        'full_name',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'trial_ends_at',
        'is_premium',
        'is_admin',
        ...self::PRIVATE_PROFILE_ATTRIBUTES,
        'city',
        'email_notifications',
        'push_notifications',
        'new_match_notifications',
        'message_notifications',
        'profile_visibility',
        'show_online',
        'show_location',
    ];

    /**
     * The model's default values for attributes with database defaults.
     *
     * @var array<string, bool|string>
     */
    protected $attributes = [
        'is_premium' => false,
        'is_admin' => false,
        'email_notifications' => true,
        'push_notifications' => true,
        'new_match_notifications' => true,
        'message_notifications' => true,
        'profile_visibility' => 'public',
        'show_online' => true,
        'show_location' => true,
    ];

    /**
     * The attributes appended to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'age',
        'avatar_url',
    ];

    /**
     * Assign the trial period when a male member is created.
     */
    protected static function booted(): void
    {
        static::creating(function (self $user): void {
            if ($user->gender === Gender::Male && $user->trial_ends_at === null) {
                $user->trial_ends_at = now()->addDays(self::TRIAL_DAYS);
            }
        });
    }

    /**
     * Determine whether the user may access the gender-filtered feed.
     */
    public function hasActiveFeedAccess(): bool
    {
        return match ($this->gender) {
            Gender::Female => true,
            Gender::Male => $this->is_premium || ($this->trial_ends_at?->isFuture() ?? false),
            null => false,
        };
    }

    /**
     * Determine whether the user's male trial has expired.
     */
    public function hasExpiredTrial(): bool
    {
        return $this->gender === Gender::Male
            && ! $this->is_premium
            && ! ($this->trial_ends_at?->isFuture() ?? false);
    }

    /**
     * Determine whether the user may send messages.
     */
    public function canSendMessages(): bool
    {
        if ($this->is_premium) {
            return true;
        }

        return match ($this->gender) {
            Gender::Female => true,
            Gender::Male => ! $this->hasExpiredTrial(),
            null => false,
        };
    }

    /**
     * Determine whether the user is an administrator.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Get the posts authored by the user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the stories authored by the user.
     */
    public function stories(): HasMany
    {
        return $this->hasMany(Story::class);
    }

    /**
     * Get the messages sent by the user.
     */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get the messages received by the user.
     */
    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Get the member's age derived from their birth date.
     */
    protected function age(): Attribute
    {
        return Attribute::get(fn (): ?int => $this->birth_date?->age);
    }

    /**
     * Get the public URL for the member's avatar.
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->profile_photo_path
            ? Storage::disk('public')->url($this->profile_photo_path)
            : null);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'gender' => Gender::class,
            'trial_ends_at' => 'datetime',
            'birth_date' => 'date',
            'is_premium' => 'boolean',
            'is_admin' => 'boolean',
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'new_match_notifications' => 'boolean',
            'message_notifications' => 'boolean',
            'show_online' => 'boolean',
            'show_location' => 'boolean',
        ];
    }
}
