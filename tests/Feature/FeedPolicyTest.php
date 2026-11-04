<?php

namespace Tests\Feature;

use App\Models\User;
use App\Policies\FeedPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class FeedPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_female_member_can_view_feed(): void
    {
        $female = User::factory()->female()->create();
        $policy = new FeedPolicy;

        $result = $policy->view($female);

        $this->assertInstanceOf(Response::class, $result);
        $this->assertTrue($result->allowed());
    }

    public function test_male_member_with_active_trial_can_view_feed(): void
    {
        Carbon::setTestNow('2026-11-01 12:00:00');

        $male = User::factory()->male()->create();
        $policy = new FeedPolicy;

        $result = $policy->view($male);

        $this->assertTrue($result->allowed());
    }

    public function test_male_member_with_expired_trial_cannot_view_feed(): void
    {
        Carbon::setTestNow('2026-11-04 12:00:00');

        $male = User::factory()->male()->create([
            'trial_ends_at' => now()->subMinute(),
        ]);
        $policy = new FeedPolicy;

        $result = $policy->view($male);

        $this->assertFalse($result->allowed());
        $this->assertSame('Your feed access is not active.', $result->message());
    }

    public function test_premium_male_member_can_view_feed_after_trial_expires(): void
    {
        Carbon::setTestNow('2026-11-04 12:00:00');

        $male = User::factory()->premium()->create();
        $policy = new FeedPolicy;

        $result = $policy->view($male);

        $this->assertTrue($result->allowed());
    }

    public function test_premium_male_member_can_publish_posts(): void
    {
        Carbon::setTestNow('2026-11-04 12:00:00');

        $male = User::factory()->premium()->create();
        $policy = new FeedPolicy;

        $result = $policy->publish($male);

        $this->assertTrue($result->allowed());
    }

    public function test_male_member_without_trial_cannot_publish_posts(): void
    {
        Carbon::setTestNow('2026-11-04 12:00:00');

        $male = User::factory()->male()->create([
            'trial_ends_at' => now()->subMinute(),
            'is_premium' => false,
        ]);
        $policy = new FeedPolicy;

        $result = $policy->publish($male);

        $this->assertFalse($result->allowed());
    }
}
