<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function authenticateAdmin(): void
    {
        $this->withSession([
            'admin_auth' => true,
            'admin_email' => 'admin@example.com',
            'admin_name' => 'Test Yönetici',
        ]);
    }

    public function test_admin_pages_require_admin_session(): void
    {
        foreach ([
            route('admin.dashboard'),
            route('admin.users'),
            route('admin.posts'),
            route('admin.messages'),
            route('admin.settings'),
        ] as $url) {
            $this->get($url)->assertRedirect(route('admin.login'));
        }
    }

    public function test_admin_login_screen_renders(): void
    {
        $this->get(route('admin.login'))
            ->assertOk()
            ->assertSee('Yönetici girişi');
    }

    public function test_admin_login_accepts_an_admin_database_account(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin@example.com',
            'password' => 'correct-password',
        ]);

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'correct-password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertTrue(session('admin_auth'));
        $this->assertSame($admin->email, session('admin_email'));
    }

    public function test_admin_login_rejects_invalid_credentials(): void
    {
        User::factory()->admin()->create(['email' => 'admin@example.com']);

        $this->post(route('admin.login.store'), [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');

        $this->assertFalse(session('admin_auth', false));
    }

    public function test_admin_pages_render_with_real_records(): void
    {
        $this->authenticateAdmin();
        $user = User::factory()->female()->create(['name' => 'Deniz Yılmaz']);
        Post::factory()->for($user)->create(['title' => 'Deniz gönderisi']);
        Message::factory()->create(['content' => 'Deniz mesajı']);

        foreach ([
            route('admin.dashboard'),
            route('admin.users'),
            route('admin.users.show', $user),
            route('admin.posts'),
            route('admin.messages'),
            route('admin.settings'),
        ] as $url) {
            $this->get($url)->assertOk();
        }

        $this->get(route('admin.dashboard'))
            ->assertSee('Deniz Yılmaz')
            ->assertSee('Deniz gönderisi');
        $this->get(route('admin.users'))
            ->assertSee('Deniz Yılmaz');
        $this->get(route('admin.messages'))
            ->assertSee('Deniz mesajı');
    }

    public function test_user_search_and_filters_use_database_results(): void
    {
        $this->authenticateAdmin();
        $matching = User::factory()->female()->create([
            'name' => 'Aranan Kişi',
            'city' => 'İzmir',
        ]);
        User::factory()->male()->create(['name' => 'Başka Kişi']);

        $this->get(route('admin.users', ['search' => 'Aranan']))
            ->assertOk()
            ->assertSee($matching->name)
            ->assertDontSee('Başka Kişi');

        $this->get(route('admin.users', ['gender' => 'male']))
            ->assertOk()
            ->assertSee('Başka Kişi')
            ->assertDontSee($matching->name);
    }

    public function test_admin_can_update_and_delete_users(): void
    {
        $this->authenticateAdmin();
        $user = User::factory()->create();

        $this->put(route('admin.users.update', $user), [
            'name' => 'Güncellenen Kullanıcı',
            'username' => 'guncellenen',
            'email' => $user->email,
            'city' => 'Ankara',
            'gender' => 'female',
            'bio' => 'Yeni biyografi',
            'profile_visibility' => 'private',
            'is_premium' => '1',
        ])->assertRedirect(route('admin.users.show', $user));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Güncellenen Kullanıcı',
            'city' => 'Ankara',
            'is_premium' => true,
        ]);

        $this->delete(route('admin.users.destroy', $user))
            ->assertRedirect(route('admin.users'));

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_accounts_cannot_be_deleted_from_panel(): void
    {
        $this->authenticateAdmin();
        $admin = User::factory()->admin()->create();

        $this->delete(route('admin.users.destroy', $admin))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_admin_can_delete_posts_and_logout_clears_session(): void
    {
        $this->authenticateAdmin();
        $post = Post::factory()->create();

        $this->delete(route('admin.posts.destroy', $post))->assertSessionHas('success');
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);

        $this->post(route('admin.logout'))->assertRedirect(route('admin.login'));
        $this->assertFalse(session('admin_auth', false));
        $this->assertNull(session('admin_email'));
    }
}
