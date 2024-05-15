<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return to_route('manager.teams.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        $users = $team->users;

        return view('manager.tasks.create', ['team' => $team, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Team $team)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $task = new Task($validated);
        $task->team_id = $team->id;
        $task->assignee_id = $request->assignee_id;
        $task->save();

        return to_route('manager.teams.show', ['team' => $team])->with('success', 'タスクを作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Task $task)
    {
        $users = $team->users;

        return view('manager.tasks.edit', compact('team', 'task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $task->fill($validated);
        $task->assignee_id = $request->assignee_id;
        $task->save();

        return to_route('manager.teams.show', ['team' => $team])->with('success', 'タスクを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
