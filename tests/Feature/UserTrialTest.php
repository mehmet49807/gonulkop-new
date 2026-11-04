<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class UserTrialTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_male_member_receives_a_three_day_trial_when_created(): void
    {
        Carbon::setTestNow('2026-11-01 12:00:00');

        $male = User::factory()->male()->create();

        $this->assertSame('2026-11-04 12:00:00', $male->trial_ends_at->toDateTimeString());
        $this->assertTrue($male->hasActiveFeedAccess());
    }

    public function test_female_member_does_not_receive_a_trial(): void
    {
        $female = User::factory()->female()->create();

        $this->assertNull($female->trial_ends_at);
        $this->assertTrue($female->hasActiveFeedAccess());
    }

    public function test_male_member_loses_feed_access_when_the_trial_expires(): void
    {
        Carbon::setTestNow('2026-11-01 12:00:00');

        $male = User::factory()->male()->create();

        Carbon::setTestNow('2026-11-04 11:59:59');
        $this->assertTrue($male->fresh()->hasActiveFeedAccess());

        Carbon::setTestNow('2026-11-04 12:00:00');
        $this->assertFalse($male->fresh()->hasActiveFeedAccess());
    }
}
