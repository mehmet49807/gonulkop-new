<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::factory()->female(),
            'recipient_id' => User::factory()->male(),
            'content' => fake()->sentence(),
            'attachment_path' => null,
            'read_at' => null,
        ];
    }
}
