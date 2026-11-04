<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_can_view_an_opposite_gender_post(): void
    {
        $female = User::factory()->female()->create();
        $post = Post::factory()->for(User::factory()->male(), 'user')->create();

        $this->actingAs($female)
            ->getJson(route('posts.show', $post))
            ->assertOk()
            ->assertJsonPath('data.id', $post->id)
            ->assertJsonPath('data.user.gender', 'male');
    }

    public function test_member_can_view_own_published_post(): void
    {
        $member = User::factory()->female()->create();
        $post = Post::factory()->for($member, 'user')->create();

        $this->actingAs($member)
            ->getJson(route('posts.show', $post))
            ->assertOk()
            ->assertJsonPath('data.id', $post->id);
    }

    public function test_member_cannot_view_a_same_gender_post(): void
    {
        $female = User::factory()->female()->create();
        $post = Post::factory()->for(User::factory()->female(), 'user')->create();

        $this->actingAs($female)
            ->getJson(route('posts.show', $post))
            ->assertForbidden()
            ->assertJsonPath('message', 'You cannot view this post.');
    }

    public function test_guest_cannot_access_the_feed(): void
    {
        $this->getJson(route('feed.index'))
            ->assertUnauthorized();
    }

    public function test_member_can_publish_and_delete_own_post(): void
    {
        $member = User::factory()->female()->create();

        $this->actingAs($member)
            ->post(route('posts.store'), [
                'title' => 'Yeni hikâyem',
                'content' => 'Bu gönderi profilimde görünecek.',
            ])
            ->assertRedirect(route('profile.index'))
            ->assertSessionHas('status', 'Gönderiniz yayımlandı.');

        $post = $member->posts()->sole();

        $this->assertSame('published', $post->status);
        $this->assertNotNull($post->published_at);

        $this->actingAs($member)
            ->delete(route('posts.destroy', $post))
            ->assertRedirect(route('profile.index'))
            ->assertSessionHas('status', 'Gönderiniz silindi.');

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_member_cannot_delete_another_members_post(): void
    {
        $owner = User::factory()->female()->create();
        $otherMember = User::factory()->female()->create();
        $post = Post::factory()->for($owner, 'user')->create();

        $this->actingAs($otherMember)
            ->delete(route('posts.destroy', $post))
            ->assertForbidden();

        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }

    public function test_expired_trial_male_cannot_publish_a_post(): void
    {
        $member = User::factory()->expiredTrial()->create();

        $this->actingAs($member)
            ->post(route('posts.store'), [
                'title' => 'Yeni hikâyem',
                'content' => 'Bu gönderi yayımlanamaz.',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('posts', 0);
    }

    public function test_post_creation_requires_title_and_content(): void
    {
        $member = User::factory()->female()->create();

        $this->actingAs($member)
            ->post(route('posts.store'))
            ->assertSessionHasErrors(['title', 'content']);

        $this->assertDatabaseCount('posts', 0);
    }
}
