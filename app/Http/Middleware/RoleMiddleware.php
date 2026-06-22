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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        // Match against both role and account_type, since a kafaa account keeps
        // its role as 'user' while account_type carries the real designation.
        $userRoles = array_filter([$user->role, $user->account_type]);

        // Admins can access everything in this simple setup.
        if (in_array('admin', $userRoles) || in_array('super admin', $userRoles)) {
            return $next($request);
        }

        if (array_intersect($userRoles, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
