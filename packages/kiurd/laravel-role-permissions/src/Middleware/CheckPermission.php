<?php


namespace kiurd\RolePermissions\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $tableName = null, $action = null)
    {
//        dd($tableName, $action);
        if (!auth()->user() || !auth()->user()->hasPermission($tableName, $action)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
