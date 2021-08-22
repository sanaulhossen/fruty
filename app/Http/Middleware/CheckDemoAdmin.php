<?php

namespace App\Http\Middleware;

use Illuminate\Support\facades\Auth;
use Closure;

class CheckDemoAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user()->role == 3) {
            return back()->with('demo_admin', 'Sorry! You can not edit.');
        }

        return $next($request);
    }
}
