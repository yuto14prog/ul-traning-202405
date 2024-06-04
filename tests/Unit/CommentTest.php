<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_function_saveComment()
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
        $comment = Comment::saveComment($task, ['message' => '1_message', 'kind' => 0]);

        $this->assertEquals(Comment::count(), $count + 1);
        $this->assertEquals($comment->message, '1_message');
        $this->assertEquals($comment->kind, 0);
        $this->assertEquals($comment->task_id, $task->id);
        $this->assertEquals($comment->author_id, $user->id);
        $this->assertEquals($task->status, 0);

        $comment = Comment::saveComment($task, ['message' => '2_message', 'kind' => 1]);

        $this->assertEquals(Comment::count(), $count + 2);
        $this->assertEquals($comment->message, '2_message');
        $this->assertEquals($comment->kind, 1);
        $this->assertEquals($comment->task_id, $task->id);
        $this->assertEquals($comment->author_id, $user->id);
        $this->assertEquals($task->status, 1);
    }
}
