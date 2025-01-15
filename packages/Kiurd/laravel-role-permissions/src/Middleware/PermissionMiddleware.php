<?php

namespace Kiurd\RolePermissions\Middleware;

use ReflectionClass;

class PermissionMiddleware
{
    /**
     * @throws \ReflectionException
     */
    public function handle($request, $next, $module, $action)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }
        $actions_batch = explode('|', $action);

        $currentAction = $request->route()->getActionMethod();

        $controller = $request->route()->getController();

        $reflection = new ReflectionClass($controller);

        $methods = array_filter(
            array_map(
                fn($method) => $method->isPublic() ? $method->getName() : null,
                $reflection->getMethods()
            )
        );

        $methods = array_filter($methods, fn($method) => !str_starts_with($method, '__'));

        foreach ($actions_batch as $action) {
            $action = explode(':', $action);
            $method = $action[1];
            $action = $action[0];

            if ($method != $currentAction) {
                abort(403, 'You do not have permission for this action.');
            }

            if (in_array($method, $methods) && $currentAction === $method) {
                if (auth()->user()->hasPermission($module, $action)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'You do not have permission for this action.');
    }
}
