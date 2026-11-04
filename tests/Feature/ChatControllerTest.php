<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_can_send_message_to_opposite_gender_member(): void
    {
        $sender = User::factory()->female()->create();
        $recipient = User::factory()->male()->create();

        $this->actingAs($sender)
            ->postJson(route('messages.store', $recipient), [
                'content' => 'Merhaba!',
            ])
            ->assertCreated()
            ->assertJsonPath('message.content', 'Merhaba!');

        $this->assertDatabaseHas('messages', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'content' => 'Merhaba!',
        ]);
    }

    public function test_member_cannot_send_message_to_same_gender_member(): void
    {
        $sender = User::factory()->female()->create();
        $recipient = User::factory()->female()->create();

        $this->actingAs($sender)
            ->postJson(route('messages.store', $recipient), [
                'content' => 'Merhaba!',
            ])
            ->assertForbidden();
    }

    public function test_expired_trial_male_must_upgrade_to_send_message(): void
    {
        $sender = User::factory()->expiredTrial()->create();
        $recipient = User::factory()->female()->create();

        $this->actingAs($sender)
            ->postJson(route('messages.store', $recipient), [
                'content' => 'Merhaba!',
            ])
            ->assertForbidden()
            ->assertJsonPath('premium_required', true);

        $this->assertDatabaseMissing('messages', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);
    }

    public function test_premium_member_can_send_message_after_trial_expires(): void
    {
        $sender = User::factory()->male()->premium()->create();
        $recipient = User::factory()->female()->create();

        $this->actingAs($sender)
            ->postJson(route('messages.store', $recipient), [
                'content' => 'Merhaba!',
            ])
            ->assertCreated();

        $this->assertDatabaseHas('messages', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);
    }

    public function test_member_cannot_send_message_to_private_profile(): void
    {
        $sender = User::factory()->female()->create();
        $recipient = User::factory()->male()->create([
            'profile_visibility' => 'private',
        ]);

        $this->actingAs($sender)
            ->postJson(route('messages.store', $recipient), [
                'content' => 'Merhaba!',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('messages', 0);
    }

    public function test_conversation_page_lists_existing_conversation_and_messages(): void
    {
        $member = User::factory()->female()->create();
        $otherMember = User::factory()->male()->create(['name' => 'Sohbet Arkadaşı']);
        Message::factory()->create([
            'sender_id' => $otherMember->id,
            'recipient_id' => $member->id,
            'content' => 'Merhaba!',
        ]);

        $this->actingAs($member)
            ->get(route('messages.show', $otherMember))
            ->assertOk()
            ->assertSee('Sohbet Arkadaşı')
            ->assertSee('Merhaba!');
    }
}
