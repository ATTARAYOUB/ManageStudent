<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
public function handle(Request $request, Closure $next, string $role): Response
{
    if (!auth()->check()) {
        return redirect('/login');
    }

    $user = auth()->user();

    // Admins can access everything
    if ($user->role === 'admin') {
        return $next($request);
    }

    // Teachers: whitelist specific paths only
    if ($user->role === 'teacher') {
        $path = '/' . $request->path();
        $allowed = ['/students', '/dashboard', '/', '/courses', '/profile'];
        $isAllowed = collect($allowed)->contains(fn($p) => str_starts_with($path, $p));

        // Block write operations for teachers (POST/PUT/DELETE on students)
        if ($request->isMethod('POST') || $request->isMethod('PUT') || $request->isMethod('DELETE')) {
            abort(403, 'Teachers cannot modify records.');
        }

        if (!$isAllowed) {
            abort(403, 'Access denied.');
        }
        return $next($request);
    }

    // For any other role check
    if ($user->role !== $role) {
        abort(403, 'Access denied.');
    }

    return $next($request);
}


}
