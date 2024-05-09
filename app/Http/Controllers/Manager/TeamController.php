<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // 操作しているユーザー情報を取得
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);

        $validated['owner_id'] = $user->id;

        $team = new Team($validated);
        $team->save();

        return to_route('manager.teams.show', ['team' => $team])->with('success', 'チームを作成しました');
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

        return to_route('manager.teams.edit', ['team' => $team])->with('success', 'チームを更新しました');
    }
}
