<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if(Auth::user()->role_id != 1) {
                return redirect('');
            }
        } else {
            return redirect('');
        }
        return $next($request);
    }
}
