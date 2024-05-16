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

        $team = Team::createWithOwner($user, $data);
        $member = $team->members()->where('user_id', $user->id)->first();

        // Teams
        $this->assertTrue($team->exists);
        $this->assertEquals($team->owner_id, $user->id);

        // Members
        $this->assertTrue($member->exists);
        $this->assertEquals($member->user_id, $user->id);
        $this->assertEquals($member->role, 1);
    }
}
