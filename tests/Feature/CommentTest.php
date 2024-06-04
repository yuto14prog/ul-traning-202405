<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_comment_get()
    {
        $user1 = User::factory()->create();
        Sanctum::actingAs($user1);
        $user2 = User::factory()->create();
        $team = Team::createWithOwner($user1, ['name' => 'test_team']);
        $task = new Task([
            'title' => 'task_title',
            'body' => 'task_body',
        ]);
        $task->team_id = $team->id;
        $task->assignee_id = $user1->id;
        $task->save();

        $comment1 = new Comment([
            'message' => 'user1_message',
            'kind' => 0,
        ]);
        $comment1->task_id = $task->id;
        $comment1->author_id = $user1->id;
        $comment1->save();
        $comment2 = new Comment([
            'message' => 'user2_message',
            'kind' => 0,
        ]);
        $comment2->task_id = $task->id;
        $comment2->author_id = $user2->id;
        $comment2->save();

        $response = $this->get(route('api.comments.index', ['task' => $task->id]));

        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJson(fn (AssertableJson $json) => 
            $json->has(0, fn ($json) =>
                $json->where('task_id', $task->id)
                    ->where('author_id', $user1->id)
                    ->where('message', 'user1_message')
                    ->where('kind', 0)
                    ->has('user', fn ($json) =>
                        $json->where('id', $user1->id)
                            ->etc()
                    )
                    ->etc()
            )->has(1, fn ($json) =>
                $json->where('task_id', $task->id)
                    ->where('author_id', $user2->id)
                    ->where('message', 'user2_message')
                    ->where('kind', 0)
                    ->has('user', fn ($json) =>
                        $json->where('id', $user2->id)
                            ->etc()
                    )
                    ->etc()
            )
        );
    }

    public function test_api_comment_post()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $team = Team::createWithOwner($user, ['name' => 'test_team']);
        $task = new Task([
            'title' => 'task_title',
            'body' => 'task_body',
        ]);
        $task->team_id = $team->id;
        $task->assignee_id = $user->id;
        $task->save();

        $count = Comment::count();
        $response = $this->postJson(
            route('api.comments.store', ['task' => $task->id]),
            ['message' => 'test_message', 'kind' => 0]
        );
        $comment = Comment::latest()->first();

        $response->assertStatus(201);
        $this->assertEquals(Comment::count(), $count + 1);
        $this->assertEquals($comment->task_id, $task->id);
        $this->assertEquals($comment->author_id, $user->id);
        $this->assertEquals($comment->message, 'test_message');
        $this->assertEquals($comment->kind, 0);

        $count = Comment::count();
        $response = $this->postJson(
            route('api.comments.store', ['task' => $task->id]),
            ['message' => '', 'kind' => 0]
        );
        $response->assertStatus(422);
        $response->assertJson(['message' => 'messageは必須です。']);
        $this->assertEquals(Comment::count(), $count);
    }
}
