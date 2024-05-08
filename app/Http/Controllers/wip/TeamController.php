<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('manager.teams.index', compact('teams'));
    }

    public function show(Team $team)
    {
        return view('manager.teams.show', compact('team'));
    }

    public function create()
    {
        return view('manager.teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'owner_id' => 'required'
        ]);

        $team = new Team($validated);
        $team->save();

        return to_route('manager.teams.show', ['team' => $team])->with('success', 'チームを作成しました');
    }

    public function edit(Team $team)
    {
        return view('manager.teams.edit', compact('team'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);

        $team = Team::find($request->id);
        $team->update([
            'name' => $validated['name']
        ]);

        return to_route('manager.teams.edit', ['team' => $team])->with('success', 'チームを更新しました');
    }
}
