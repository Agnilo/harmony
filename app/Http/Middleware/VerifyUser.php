<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUser
{
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->is_verified) {
            return redirect()->route('verification');
        }

        return $next($request);
    }
}
