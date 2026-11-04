<?php

namespace Tests\Feature;

use App\Gender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_guest_can_view_login_and_registration_pages(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Giriş yap');

        $this->get(route('register'))
            ->assertOk()
            ->assertSee('Hesap oluştur');
    }

    public function test_male_registration_assigns_three_day_trial_in_controller_and_hashes_password(): void
    {
        Carbon::setTestNow('2026-11-01 12:00:00');
        Storage::fake('public');

        $response = $this->post(route('register.store'), [
            'name' => 'Görünen Ad',
            'email' => 'erkek@example.com',
            'password' => 'password-123',
            'password_confirmation' => 'password-123',
            'gender' => Gender::Male->value,
            'birth_date' => '1995-05-10',
            'city' => 'İstanbul',
            'bio' => 'Yeni hikâyem.',
            'profile_photo' => UploadedFile::fake()->createWithContent(
                'avatar.png',
                base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
            ),
        ]);

        $response->assertRedirect(route('feed.index'));
        $this->assertAuthenticated();

        $user = User::query()->where('email', 'erkek@example.com')->sole();

        $this->assertSame('2026-11-04 12:00:00', $user->trial_ends_at->toDateTimeString());
        $this->assertTrue(Hash::check('password-123', $user->password));
        $this->assertSame('Yeni hikâyem.', $user->bio);
        Storage::disk('public')->assertExists($user->profile_photo_path);
    }

    public function test_female_registration_does_not_receive_a_trial(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Görünen Ad',
            'email' => 'kadin@example.com',
            'password' => 'password-123',
            'password_confirmation' => 'password-123',
            'gender' => Gender::Female->value,
            'birth_date' => '1997-06-11',
            'city' => 'Ankara',
        ])->assertRedirect(route('feed.index'));

        $user = User::query()->where('email', 'kadin@example.com')->sole();

        $this->assertNull($user->trial_ends_at);
    }

    public function test_member_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create([
            'email' => 'uye@example.com',
            'password' => 'password-123',
        ]);

        $this->post(route('login.store'), [
            'email' => 'uye@example.com',
            'password' => 'password-123',
        ])->assertRedirect(route('feed.index'));

        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_login_endpoint_is_rate_limited(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('login.store'), [
                'email' => 'olmayan@example.com',
                'password' => 'wrong-password',
            ])->assertRedirect();
        }

        $this->post(route('login.store'), [
            'email' => 'olmayan@example.com',
            'password' => 'wrong-password',
        ])->assertTooManyRequests();
    }
}
