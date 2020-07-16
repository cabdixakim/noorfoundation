<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class is_sponsor
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
        if (auth()->check() && auth()->user()->user_type == 'sponsor') {
            # code...
            return $next($request);
        }
        return redirect('/');
    }
}
