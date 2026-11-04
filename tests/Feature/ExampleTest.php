<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_the_home_page(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Tanışmanın en doğal yolu')
            ->assertSee(route('register'));
    }

    public function test_authenticated_member_can_view_the_home_page(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('home'))
            ->assertOk()
            ->assertSee('Akışı keşfet')
            ->assertSee(route('feed.index'));
    }
}
