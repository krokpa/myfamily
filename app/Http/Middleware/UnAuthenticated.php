<?php

namespace App\Http\Middleware;
use Closure;

class UnAuthenticated
{
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('loggedIn')) {
            return redirect()->route('index');
        }
        return $next($request);
    }
}
