<?php

namespace Tests\Feature;

use App\Models\Family;
use App\Models\Person;
use App\Models\User;
use App\Notifications\PersonCreatedSlackMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Support\Str;

class PersonControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * GET 'api/people/{person}'
     */
    public function a_user_can_get_person_information_with_families_tree()
    {
        $user = User::factory()->create();

        $person = Person::factory()->hasAttached($family = Family::factory()->create())->create();

        $response = $this->actingAs($user, 'api')->json('GET', "/api/people/{$person->id}");

        $response = json_decode($response->getContent());

        $this->assertEquals($person->name, $response->name);
        $this->assertEquals($family->name, $response->families[0]->name);
    }

    /**
     * @test
     * GET 'api/people/{person}'
     */
    public function a_guest_cannot_get_person_information_with_families_tree()
    {
        $person = Person::factory()->hasAttached($family = Family::factory()->create())->create();

        $response = $this->json('GET', "/api/people/{$person->id}");

        $response->assertStatus(401);

        $response = json_decode($response->getContent());

        $this->assertEquals('Unauthenticated.', $response->message);
    }

    /**
     * @test
     * POST 'api/people'
     */
    public function a_user_can_create_people()
    {
        Notification::fake();

        $admin = User::factory()->create(['email' => 'admin@admin.test']);
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json('POST', "/api/people", [
            'name' => $person = 'Sergio'
        ]);

        $response->assertStatus(201);

        $response = json_decode($response->getContent());

        $this->assertEquals($person, $response->name);

        Notification::assertSentTo([$admin], PersonCreatedSlackMessage::class);
    }

    /**
     * @test
     * POST 'api/people'
     */
    public function a_guest_cannot_create_people()
    {
        $response = $this->json('POST', "/api/people", [
            'name' => $person = 'Sergio'
        ]);

        $response->assertStatus(401);

        $response = json_decode($response->getContent());

        $this->assertEquals('Unauthenticated.', $response->message);
    }

    /**
     * @test
     * @dataProvider provideWeirdNameInputs
     * POST 'api/people'
     */
    public function a_user_cannot_create_people_with_weird_name_values($input)
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json('POST', "/api/people", [
            'name' => $input
        ]);

        $response->assertStatus(422);
    }

    public function provideWeirdNameInputs(){
        return [
            ['28892'],
            [null],
            ['[]'],
            ["' 1 OR 1"],
            ['"" 1 OR 1'],
            [Str::random(1000)],
            ['<script>'],
            ['"<script>'],
            ["'<script>"],
            ["\'<script>"],
            [0],
            [false],
            [true],
        ];
    }

    /**
     * Regression test [Link to bug]
     * @test
     * POST 'api/people'
     */
    public function a_user_can_create_people_with_name_with_spaces()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json('POST', "/api/people", [
            'name' => $person = 'Sergio Rodenas'
        ]);

        $response->assertStatus(201);

        $response = json_decode($response->getContent());

        $this->assertEquals($person, $response->name);
    }
}
