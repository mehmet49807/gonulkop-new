<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_can_update_notification_and_privacy_preferences(): void
    {
        $member = User::factory()->create();

        $this->actingAs($member)
            ->patch(route('settings.update'), [
                'email_notifications' => false,
                'push_notifications' => true,
                'new_match_notifications' => false,
                'message_notifications' => true,
                'profile_visibility' => 'members',
                'show_online' => false,
                'show_location' => false,
            ])
            ->assertRedirect(route('settings.edit'));

        $member->refresh();

        $this->assertFalse($member->email_notifications);
        $this->assertTrue($member->push_notifications);
        $this->assertFalse($member->new_match_notifications);
        $this->assertTrue($member->message_notifications);
        $this->assertSame('members', $member->profile_visibility);
        $this->assertFalse($member->show_online);
        $this->assertFalse($member->show_location);
    }

    public function test_member_can_change_password_after_confirming_current_password(): void
    {
        $member = User::factory()->create([
            'password' => 'old-password',
        ]);

        $this->actingAs($member)
            ->put(route('settings.password'), [
                'current_password' => 'old-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->assertRedirect(route('settings.edit'));

        $this->assertTrue(Hash::check('new-password', $member->fresh()->password));
    }

    public function test_account_deletion_requires_current_password_and_deletes_account(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('profile-photos/member.png', 'profile-photo');
        $member = User::factory()->create([
            'password' => 'password-123',
            'profile_photo_path' => 'profile-photos/member.png',
        ]);

        $this->actingAs($member)
            ->delete(route('settings.destroy'), [
                'current_password' => 'wrong-password',
            ])
            ->assertSessionHasErrors('current_password');

        $this->assertDatabaseHas('users', ['id' => $member->id]);

        $this->actingAs($member)
            ->delete(route('settings.destroy'), [
                'current_password' => 'password-123',
            ])
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('users', ['id' => $member->id]);
        Storage::disk('public')->assertMissing('profile-photos/member.png');
        $this->assertGuest();
    }
}
