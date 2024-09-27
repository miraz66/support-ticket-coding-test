<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if the user is logged in and has the specified role
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // If the user doesn't have the required role, redirect to home or an error page
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
