<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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

        if (!$request->user()->isManager($team)) {
            return redirect('/')->with('danger', 'アクセスできません');
        }

        return $next($request);
    }
}
