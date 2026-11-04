<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class PostPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_female_member_can_view_a_published_male_post(): void
    {
        $female = User::factory()->female()->create();
        $post = Post::factory()->for(User::factory()->male(), 'user')->create();

        $this->assertTrue(Gate::forUser($female)->allows('view', $post));
    }

    public function test_female_member_cannot_view_a_published_female_post(): void
    {
        $female = User::factory()->female()->create();
        $post = Post::factory()->for(User::factory()->female(), 'user')->create();

        $this->assertFalse(Gate::forUser($female)->allows('view', $post));
    }

    public function test_male_member_with_active_trial_can_view_a_published_female_post(): void
    {
        $male = User::factory()->male()->create();
        $post = Post::factory()->for(User::factory()->female(), 'user')->create();

        $this->assertTrue(Gate::forUser($male)->allows('view', $post));
    }

    public function test_male_member_with_active_trial_cannot_view_a_published_male_post(): void
    {
        $male = User::factory()->male()->create();
        $post = Post::factory()->for(User::factory()->male(), 'user')->create();

        $this->assertFalse(Gate::forUser($male)->allows('view', $post));
    }

    public function test_member_cannot_view_an_unpublished_post(): void
    {
        $female = User::factory()->female()->create();
        $post = Post::factory()->draft()->for(User::factory()->male(), 'user')->create();

        $this->assertFalse(Gate::forUser($female)->allows('view', $post));
    }

    public function test_male_member_with_expired_trial_cannot_view_any_post(): void
    {
        $male = User::factory()->expiredTrial()->create();
        $post = Post::factory()->for(User::factory()->female(), 'user')->create();

        $this->assertFalse(Gate::forUser($male)->allows('view', $post));
    }

    public function test_feed_access_requires_a_gender_and_active_male_trial(): void
    {
        $female = User::factory()->female()->create();
        $activeMale = User::factory()->male()->create();
        $expiredMale = User::factory()->expiredTrial()->create();
        $genderless = User::factory()->create(['gender' => null]);

        $this->assertTrue(Gate::forUser($female)->allows('viewAny', Post::class));
        $this->assertTrue(Gate::forUser($activeMale)->allows('viewAny', Post::class));
        $this->assertFalse(Gate::forUser($expiredMale)->allows('viewAny', Post::class));
        $this->assertFalse(Gate::forUser($genderless)->allows('viewAny', Post::class));
    }
}
