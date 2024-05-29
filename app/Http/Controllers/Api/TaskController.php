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
            $task::join('teams', 'tasks.team_id', '=', 'teams.id')->where('tasks.id', $task->id)->get()
        );
    }
}
