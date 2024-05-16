<?php

namespace Tests\Unit;

use App\Models\Member;
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
        $team_count = Team::count();
        $member_count = Member::count();

        $data = ['name' => 'teamname'];
        $user = User::factory()->create();

        $team = Team::createWithOwner($user, $data);
        $member = $team->members()->where('user_id', $user->id)->first();

        // Teams
        $this->assertEquals($team_count + 1, Team::count());
        $this->assertTrue($team->exists);
        $this->assertEquals($team->name, $data['name']);
        $this->assertEquals($team->owner_id, $user->id);

        // Members
        $this->assertEquals($member_count + 1, Member::count());
        $this->assertTrue($member->exists);
        $this->assertEquals($member->user_id, $user->id);
        $this->assertEquals($member->role, 1);
    }
}
