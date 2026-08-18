<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {
        // Check if user is logged in
        if (!auth()->check()) {

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated.',
                ], 401);
            }

            return redirect()->route('login');
        }

        // Get current user's role
        $userRole = auth()->user()->role;

        if ($userRole instanceof \BackedEnum) {
            $userRole = $userRole->value;
        }

        // Compare roles case-insensitively
        $allowed = collect($roles)->contains(
            fn ($role) => strtolower($role) === strtolower($userRole)
        );

        if (!$allowed) {

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access.',
                ], 403);
            }

            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}