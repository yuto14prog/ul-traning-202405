<?php

namespace App\Http\Controllers\Api\Me;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $team = $user->teams()
            ->with([ 'members' => function($query) use ($user) {$query->where('user_id', $user->id);} ])
            ->get();

        return response()->json($team);
    }
}
