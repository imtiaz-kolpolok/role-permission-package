<?php

namespace kiurd\RolePermissions\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $module, string $action)
    {
        if (!$module || !$action) {
            abort(403, 'Invalid permission check parameters.');
        }

        if (!auth()->check() || !auth()->user()->hasPermission($module, $action)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
