<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // パラメータの`{team}`を取得（←学習のため）
        $team = $request->route()->parameter('team');
        $user = Auth::user();

        if (!$team->isManager($user)) {
            return redirect('/')->with('danger', 'アクセスできません');
        }

        return $next($request);
    }
}
