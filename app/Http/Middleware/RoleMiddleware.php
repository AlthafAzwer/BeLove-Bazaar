<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request with role-based access control.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the user is authenticated and if their role is in the allowed roles list
        if (Auth::check() && Auth::user()->roles->pluck('name')->intersect($roles)->isNotEmpty()) {
            return $next($request);
        }

        // If not authorized, redirect to the home page with an error message
        return redirect('/')->with('error', 'Access denied.');
    }
}
