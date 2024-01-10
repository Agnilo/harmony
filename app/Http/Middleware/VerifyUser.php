<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUser
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->is_verified){
            return $next($request);
        } else {
            return redirect()->route('verification');
        }
    }
}
