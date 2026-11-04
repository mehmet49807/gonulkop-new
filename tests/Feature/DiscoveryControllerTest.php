<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiscoveryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_discovery_returns_only_opposite_gender_members_matching_city_and_age_filters(): void
    {
        $viewer = User::factory()->female()->create();

        $matching = User::factory()->male()->create([
            'name' => 'Eşleşen Üye',
            'city' => 'İstanbul',
            'birth_date' => '1996-05-10',
        ]);
        $wrongCity = User::factory()->male()->create([
            'name' => 'Farklı Şehir',
            'city' => 'Ankara',
            'birth_date' => '1996-05-10',
        ]);
        $wrongAge = User::factory()->male()->create([
            'name' => 'Farklı Yaş',
            'city' => 'İstanbul',
            'birth_date' => '1970-01-01',
        ]);
        $sameGender = User::factory()->female()->create([
            'name' => 'Aynı Cinsiyet',
            'city' => 'İstanbul',
            'birth_date' => '1996-05-10',
        ]);

        $response = $this->actingAs($viewer)->getJson(route('discover.index', [
            'city' => 'İstanbul',
            'min_age' => 25,
            'max_age' => 35,
        ]));

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $matching->id);

        $ids = array_column($response->json('data'), 'id');

        $this->assertNotContains($wrongCity->id, $ids);
        $this->assertNotContains($wrongAge->id, $ids);
        $this->assertNotContains($sameGender->id, $ids);
    }

    public function test_discovery_hides_city_when_member_disables_location(): void
    {
        $viewer = User::factory()->female()->create();
        $member = User::factory()->male()->create([
            'city' => 'İzmir',
            'show_location' => false,
        ]);

        $this->actingAs($viewer)
            ->getJson(route('discover.index'))
            ->assertOk()
            ->assertJsonPath('data.0.city', null)
            ->assertJsonPath('data.0.id', $member->id);
    }

    public function test_discovery_returns_visible_city_when_member_enables_location(): void
    {
        $viewer = User::factory()->female()->create();
        $member = User::factory()->male()->create([
            'city' => 'İzmir',
            'show_location' => true,
        ]);

        $this->actingAs($viewer)
            ->getJson(route('discover.index'))
            ->assertOk()
            ->assertJsonPath('data.0.city', 'İzmir')
            ->assertJsonPath('data.0.id', $member->id);
    }

    public function test_discovery_excludes_private_profiles_from_other_members(): void
    {
        $viewer = User::factory()->female()->create();
        $privateMember = User::factory()->male()->create([
            'profile_visibility' => 'private',
        ]);

        $this->actingAs($viewer)
            ->getJson(route('discover.index'))
            ->assertOk()
            ->assertJsonMissing(['id' => $privateMember->id]);
    }
}
