<?php

namespace Tests\Feature\Me;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_me_tasks()
    {
        $user = User::factory()->make();
        Sanctum::actingAs($user);

        $task1 = new Task([
            'title' => 'title1',
            'body' => 'body1',
            'status' => 0,
            'assignee_id' => $user->id,
        ]);
        $task1->team_id = 1;
        $task1->save();
        $task2 = new Task([
            'title' => 'title2',
            'body' => 'body2',
            'status' => 0,
            'assignee_id' => $user->id,
        ]);
        $task2->team_id = 1;
        $task2->save();

        $response = $this->getJson(route('api.me.index'));

        $response->assertOk();
        $response->assertJsonCount(2);
    }
}
