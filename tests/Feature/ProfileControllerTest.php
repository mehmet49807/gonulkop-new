<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_see_private_contact_fields_on_own_profile(): void
    {
        $owner = User::factory()->female()->create([
            'full_name' => 'Gizli Ad Soyad',
            'phone' => '+90 555 111 22 33',
        ]);

        $this->actingAs($owner)
            ->get(route('profile.index'))
            ->assertOk()
            ->assertSee('Gizli Ad Soyad')
            ->assertSee('+90 555 111 22 33');
    }

    public function test_other_member_cannot_see_private_contact_fields_on_public_profile(): void
    {
        $owner = User::factory()->female()->create([
            'full_name' => 'Gizli Ad Soyad',
            'phone' => '+90 555 111 22 33',
        ]);
        $viewer = User::factory()->male()->create();

        $this->actingAs($viewer)
            ->get(route('profiles.show', $owner))
            ->assertOk()
            ->assertDontSee('Gizli Ad Soyad')
            ->assertDontSee('+90 555 111 22 33');
    }

    public function test_admin_can_see_private_contact_fields_on_member_profile(): void
    {
        $owner = User::factory()->female()->create([
            'email' => 'owner@example.com',
            'full_name' => 'Gizli Ad Soyad',
            'phone' => '+90 555 111 22 33',
        ]);
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route('profiles.show', $owner))
            ->assertOk()
            ->assertSee('owner@example.com')
            ->assertSee('Gizli Ad Soyad')
            ->assertSee('+90 555 111 22 33')
            ->assertDontSee('Değişiklikleri kaydet');
    }

    public function test_admin_cannot_bypass_hidden_location_preference(): void
    {
        $owner = User::factory()->female()->create([
            'city' => 'Gizli Şehir',
            'show_location' => false,
        ]);
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route('profiles.show', $owner))
            ->assertOk()
            ->assertDontSee('Gizli Şehir');
    }

    public function test_owner_can_update_profile_and_avatar(): void
    {
        Storage::fake('public');
        $owner = User::factory()->female()->create();

        $this->actingAs($owner)
            ->put(route('profile.update'), [
                'name' => 'Yeni Görünen Ad',
                'username' => 'yeni-kullanici',
                'full_name' => 'Yeni Ad Soyad',
                'phone' => '+90 555 444 55 66',
                'bio' => 'Yeni biyografi.',
                'city' => 'İzmir',
                'birth_date' => '1995-05-10',
                'profile_photo' => UploadedFile::fake()->createWithContent(
                    'avatar.png',
                    base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
                ),
            ])
            ->assertRedirect(route('profile.index'));

        $owner->refresh();

        $this->assertSame('Yeni Görünen Ad', $owner->name);
        $this->assertSame('Yeni Ad Soyad', $owner->full_name);
        $this->assertSame('Yeni biyografi.', $owner->bio);
        Storage::disk('public')->assertExists($owner->profile_photo_path);
    }

    public function test_profile_update_cannot_reset_expired_male_trial_through_gender_field(): void
    {
        $owner = User::factory()->expiredTrial()->create();
        $originalTrial = $owner->trial_ends_at;

        $this->actingAs($owner)
            ->put(route('profile.update'), [
                'name' => 'Görünen Ad',
                'gender' => 'male',
            ])
            ->assertRedirect(route('profile.index'));

        $this->assertTrue($owner->fresh()->trial_ends_at->equalTo($originalTrial));
    }
}
