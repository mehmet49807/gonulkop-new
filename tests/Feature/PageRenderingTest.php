<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageRenderingTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_pages_render_for_supported_member(): void
    {
        $member = User::factory()->female()->create();
        $otherMember = User::factory()->male()->create();

        $this->actingAs($member);

        foreach ([
            route('feed.index'),
            route('discover.index'),
            route('messages.index'),
            route('messages.show', $otherMember),
            route('profile.index'),
            route('profiles.show', $otherMember),
            route('settings.edit'),
        ] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_guest_pages_render_for_authentication(): void
    {
        $this->get(route('login'))->assertOk();
        $this->get(route('register'))->assertOk();
    }
}
