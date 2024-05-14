<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        //
    }

    public function show(Team $team)
    {
        $tasks = Task::all()->where('team_id', $team->id);
        return view('manager.teams.show', compact('team', 'tasks'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Team $team)
    {
        return view('manager.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);

        $team->update([
            'name' => $validated['name']
        ]);
        // $team->update($validated) ←←学習のため（こうも書ける）

        return to_route('manager.teams.edit', ['team' => $team])->with('success', 'チームを更新しました');
    }
}
