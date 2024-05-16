<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

class TeamTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_createWithOwner()
    {
        $data = ['name' => 'teamname'];
        $user = User::factory()->create();

        $resultTeam = Team::createWithOwner($user, $data);
        $resultMember = $resultTeam->members()->where('user_id', $user->id)->first();

        // Teams
        $this->assertDatabaseHas('teams', ['name' => $data['name']]);
        $this->assertEquals($resultTeam->owner_id, $user->id);

        // Members
        $this->assertDatabaseHas('members', ['user_id' => $user->id]);
        $this->assertEquals($resultMember->role, 1);
    }
}
