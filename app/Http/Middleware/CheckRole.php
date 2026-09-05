<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Super Admin bypasses role restrictions
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        $userRole = $user->role;
        // Normalize 'user' to 'member'
        if ($userRole === 'user') {
            $userRole = 'member';
        }

        foreach ($roles as $role) {
            $normalizedRole = $role === 'user' ? 'member' : $role;
            if ($userRole === $normalizedRole) {
                return $next($request);
            }
        }

        abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
    }
}
