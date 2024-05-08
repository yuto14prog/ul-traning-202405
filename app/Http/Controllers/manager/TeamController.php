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
}
