<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBanned
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
        if (auth()->check() && auth()->user()->deleted_at != null) {
            # code...
             Auth::logout();
            return redirect()->route('login')->with('status', 'Your account is suspended! Contact an admin');
        }
        return $next($request);
    }
}
