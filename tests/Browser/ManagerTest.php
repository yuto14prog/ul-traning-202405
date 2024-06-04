<?php

namespace Tests\Browser;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ManagerTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_exists_testteam_in_teams(): void
    {
        $user = User::factory()->create();
        $team = new Team(['name' => 'TestTeam']);
        $team->owner_id = $user->id;
        $team->save();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $browser->visit('/');
            $browser->screenshot('home');

            $browser->assertSeeLink('チームリンク');
        });
    }
}
