<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    // ใช้แบบ: ->middleware('role:admin') หรือ 'role:admin,staff'
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            abort(401, 'Unauthorized');
        }

        if (empty($roles)) {
            return $next($request);
        }

        $userRole = strtolower((string) $user->role);
        $roles    = array_map('strtolower', $roles);

        // ถ้ามี helper isAdmin ให้ admin ผ่านได้ทุกอย่าง
        if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return $next($request);
        }

        if (!in_array($userRole, $roles, true)) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
