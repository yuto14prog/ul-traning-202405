<?php

namespace Tests\Feature\Me;

use App\Models\Member;
use App\Models\Team;
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
        $another_user = User::factory()->create();
        Sanctum::actingAs($user);

        $team1 = Team::createWithOwner($user, ['name' => 'team1']);
        $team2 = Team::createWithOwner($another_user, ['name' => 'team2']);
        $userTeam2 = new Member();
        $userTeam2->team_id = $team2->id;
        $userTeam2->user_id = $user->id;
        $userTeam2->save();
        $another_team = Team::createWithOwner($another_user, ['name' => 'another_team']);

        $response = $this->getJson(route('api.me.teams'));

        $response->assertOk();
        $response->assertJsonCount(2);
        $response->assertJsonCount(1, '0.members');
        $response->assertJsonCount(1, '1.members');
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'owner_id',
                'created_at',
                'updated_at',
                'pivot',
                'members',
                ]
            ]);
        $response->assertJson([0 => [
            'id' => $team1->id,
            'name' => 'team1',
            'members' => [ 0 => [
                'user_id' => $user->id,
                'team_id' => $team1->id,
                'role' => 1
            ]],
        ]]);
        $response->assertJson([1 => [
            'id' => $team2->id,
            'name' => 'team2',
            'members' => [ 0 => [
                'user_id' => $user->id,
                'team_id' => $team2->id,
                'role' => 0
            ]],
        ]]);
    }
}
