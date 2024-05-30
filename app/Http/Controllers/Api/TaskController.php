<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show(Task $task)
    {
        return response()->json(
            Task::with('team')->where('id', $task->id)->get()
        );
    }
}
