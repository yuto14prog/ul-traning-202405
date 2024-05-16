<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_api_show()
    {
        $user = User::factory()->make();
        Sanctum::actingAs($user);
        
        $task = new Task([
            'title' => 'test_title',
            'body' => 'test_body',
            'status' => 0,
            'assignee_id' => null,
        ]);
        $task->team_id = 1;
        $task->save();
        
        $response = $this->getJson(route('api.task', ['task' => $task]));
        // `Sanctum::actingAs($user);`をしない場合は以下（←学習のため）
        // $response = $this->actingAs($user)->getJson(route('api.task', ['task' => $task]));

        $response->assertOk();
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('team_id', 1)
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
