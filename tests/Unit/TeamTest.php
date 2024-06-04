<?php

namespace Tests\Unit;

use App\Models\Member;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
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
        $this->assertEquals('teamname', $team->name);
        $this->assertEquals($user->id, $team->owner_id);

        // Members
        $this->assertEquals($member_count + 1, Member::count());
        $this->assertTrue($member->exists);
        $this->assertEquals($user->id, $member->user_id);
        $this->assertEquals(1, $member->role);
    }
}
