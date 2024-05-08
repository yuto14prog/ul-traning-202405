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
        $teams = Team::all();
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
        return to_route('manager.teams.index');
    }
}
