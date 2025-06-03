<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!in_array($user->role, $roles)) {
            // Redirect to login page or show Unauthorized page
            return redirect()->route('login')->with('error', 'Unauthorized access!');
        }

        return $next($request);
    }
}
