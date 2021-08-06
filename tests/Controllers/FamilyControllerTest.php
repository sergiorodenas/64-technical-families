<?php

namespace Tests\Feature;

use App\Models\Family;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FamilyControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * POST 'api/families'
     */
    public function a_user_can_create_families()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json('POST', '/api/families', [
            'name' => $family = 'Rodenas'
        ]);

        $response = json_decode($response->getContent());

        $this->assertEquals($family, $response->name);
    }

    /**
     * @test
     * POST 'api/families'
     */
    public function a_guest_cannot_create_families()
    {
        $response = $this->json('POST', '/api/families', [
            'name' => $family = 'Rodenas'
        ]);

        $response->assertStatus(401);

        $response = json_decode($response->getContent());

        $this->assertEquals('Unauthenticated.', $response->message);
    }

    /**
     * @test
     * PUT 'api/families/{family}/people/{person}'
     */
    public function a_user_can_add_people_to_families()
    {
        $user = User::factory()->create();

        $family = Family::factory()->create();
        $person = Person::factory()->create();

        $response = $this->actingAs($user, 'api')->json('PUT', "/api/families/{$family->id}/people/{$person->id}");

        $response->assertStatus(200);

        $response = json_decode($response->getContent());

        $this->assertEquals('Person added to family successfully', $response);
    }

    /**
     * @test
     * PUT 'api/families/{family}/people/{person}'
     */
    public function a_guest_cannot_add_people_to_families()
    {
        $family = Family::factory()->create();
        $person = Person::factory()->create();

        $response = $this->json('PUT', "/api/families/{$family->id}/people/{$person->id}");

        $response->assertStatus(401);

        $response = json_decode($response->getContent());

        $this->assertEquals('Unauthenticated.', $response->message);
    }

    /**
     * Regression test [Link to bug]
     * @test
     * POST 'api/families'
     */
    public function a_user_can_create_families_with_name_with_spaces()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json('POST', '/api/families', [
            'name' => $family = 'Rodenas Gomez'
        ]);

        $response = json_decode($response->getContent());

        $this->assertEquals($family, $response->name);
    }
}
