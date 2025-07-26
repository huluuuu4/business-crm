<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'Admin') {
            return $next($request);
        }
        
        // If the user is not an Admin, send them away.
        return redirect()->route('dashboard');
    }
}