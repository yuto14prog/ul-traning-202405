<?php

namespace Tests\Feature\Me;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_me_teams()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson(route('api.me.teams'));

        $response->assertOk();
    }
}
