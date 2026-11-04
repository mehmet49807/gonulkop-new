<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_female_member_receives_only_published_male_posts(): void
    {
        $female = User::factory()->female()->create();
        $malePost = Post::factory()->for(User::factory()->male(), 'user')->create();
        $femalePost = Post::factory()->for(User::factory()->female(), 'user')->create();
        $draftMalePost = Post::factory()->draft()->for(User::factory()->male(), 'user')->create();

        $response = $this->actingAs($female)->getJson(route('feed.index'));

        $response
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $malePost->id);

        $postIds = array_column($response->json('data'), 'id');

        $this->assertNotContains($femalePost->id, $postIds);
        $this->assertNotContains($draftMalePost->id, $postIds);
    }

    public function test_male_member_with_active_trial_receives_only_published_female_posts(): void
    {
        $male = User::factory()->male()->create();
        $femalePost = Post::factory()->for(User::factory()->female(), 'user')->create();
        $malePost = Post::factory()->for(User::factory()->male(), 'user')->create();

        $response = $this->actingAs($male)->getJson(route('feed.index'));

        $response
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $femalePost->id);

        $postIds = array_column($response->json('data'), 'id');

        $this->assertNotContains($malePost->id, $postIds);
    }

    public function test_male_member_with_expired_trial_cannot_access_the_feed(): void
    {
        $male = User::factory()->expiredTrial()->create();

        $this->actingAs($male)
            ->getJson(route('feed.index'))
            ->assertForbidden()
            ->assertJsonPath('message', 'Your feed access is not active.');
    }

    public function test_feed_does_not_expose_member_city_by_default(): void
    {
        $female = User::factory()->female()->create();
        $male = User::factory()->male()->create([
            'city' => 'Gizli Şehir',
            'show_location' => false,
        ]);

        Post::factory()->for($male, 'user')->create();

        $this->actingAs($female)
            ->getJson(route('feed.index'))
            ->assertOk()
            ->assertJsonMissingPath('data.0.user.city');
    }

    public function test_feed_uses_cursor_pagination_for_infinite_scrolling(): void
    {
        $female = User::factory()->female()->create();
        $male = User::factory()->male()->create();

        Post::factory()->count(3)->for($male, 'user')->create();

        $firstPage = $this->actingAs($female)
            ->getJson(route('feed.index', ['per_page' => 2]))
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('meta.per_page', 2);

        $nextCursor = $firstPage->json('meta.next_cursor');

        $this->assertNotNull($nextCursor);

        $secondPage = $this->actingAs($female)
            ->getJson(route('feed.index', ['per_page' => 2, 'cursor' => $nextCursor]))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('meta.next_cursor', null);
    }
}
