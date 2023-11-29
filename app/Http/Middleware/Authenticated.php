<?php

namespace App\Http\Middleware;
use Closure;

class Authenticated
{
    public function handle($request, Closure $next)
    {

        if (!$request->session()->has('loggedin')) {
            $request->session()->flush();
            return redirect()->route('home');
        }
        
        return $next($request);
    }
}
