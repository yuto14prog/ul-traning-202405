<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Task $task) // testする
    {
        return response()->json($task->comments()->with('user')->get());
    }

    public function store(CommentRequest $request, Task $task) // testする
    {
        // FormRequestにする
        // $validated = $request->validate([
        //     'message' => 'required|max:50',
        //     'kind' => 'integer'
        // ]);

        $comment = new Comment($request->validate());
        $comment->task_id = $task->id;
        $comment->author_id = Auth::user()->id;
        $comment->save();

        if ($comment->kind === 1) { // modelに移す
            $task->status = 1;
            $task->save();
        }
    }
}
