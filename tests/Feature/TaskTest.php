<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_api_show()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $team = Team::createWithOwner($user, ['name' => 'test_team']);
        
        $task = new Task([
            'title' => 'test_title',
            'body' => 'test_body',
            'status' => 0,
            'assignee_id' => null,
        ]);
        $task->team_id = $team->id;
        $task->save();
        
        $response = $this->getJson(route('api.task', ['task' => $task]));
        // `Sanctum::actingAs($user);`をしない場合は以下（←学習のため）
        // $response = $this->actingAs($user)->getJson(route('api.task', ['task' => $task]));

        $response->assertOk();
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('team_id', $team->id)
                ->where('title', 'test_title')
                ->where('body', 'test_body')
                ->where('status', 0)
                ->where('assignee_id', null)
                ->has('id')
                ->has('created_at')
                ->has('updated_at')
        );
    }
}
