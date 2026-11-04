<?php

namespace Database\Factories;

use App\Gender;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'gender' => Gender::Female,
            'birth_date' => fake()->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'city' => fake()->city(),
            'username' => fake()->unique()->userName(),
        ];
    }

    /**
     * Create a female member.
     */
    public function female(): static
    {
        return $this->state(fn (array $attributes) => [
            'gender' => Gender::Female,
        ]);
    }

    /**
     * Create a male member with the standard trial period.
     */
    public function male(): static
    {
        return $this->state(fn (array $attributes) => [
            'gender' => Gender::Male,
        ]);
    }

    /**
     * Create a male member whose trial has expired.
     */
    public function expiredTrial(): static
    {
        return $this->state(fn (array $attributes) => [
            'gender' => Gender::Male,
            'trial_ends_at' => now()->subMinute(),
        ]);
    }

    /**
     * Create a premium member.
     */
    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_premium' => true,
            'trial_ends_at' => now()->subMinute(),
        ]);
    }

    /**
     * Create an administrator.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => true,
            'is_premium' => true,
        ])->afterCreating(function (User $user): void {
            $user->forceFill([
                'is_admin' => true,
                'is_premium' => true,
            ])->save();
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
