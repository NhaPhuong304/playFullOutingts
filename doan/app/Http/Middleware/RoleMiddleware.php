<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Optionally accepts a role parameter (e.g. 'admin' or 'user') or numeric role id.
     */
public function handle($request, Closure $next, $role = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($role) {
            $roleRel = $user->role ?? null;
            if ($roleRel) {
                $roleName = strtolower($roleRel->name);
                if (strtolower($role) === $roleName || (is_numeric($role) && $user->role_id == intval($role))) {
                    return $next($request);
                }
            } else {
                // Fallback
                if ($role === 'admin' && !in_array($user->role_id, [2,3])) {
                    return redirect()->route('login');
                }

                if ($role === 'user' && $user->role_id != 1) {
                    return redirect()->route('login');
                }

                if (is_numeric($role) && $user->role_id != intval($role)) {
                    return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
}
