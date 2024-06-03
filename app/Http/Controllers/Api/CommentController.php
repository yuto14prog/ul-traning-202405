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
        Comment::saveComment($task, $request->all()); // testする
    }
}
