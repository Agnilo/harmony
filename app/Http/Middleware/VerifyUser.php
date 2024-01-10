<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyUser
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_verified){
            return $next($request);
        } else {
            return redirect()->route('verification');
        }
    }
}
