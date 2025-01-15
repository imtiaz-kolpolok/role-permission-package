<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use kiurd\RolePermissions\Middleware\CheckPermission;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
//        $middleware->append([
//            CheckPermission::class
//        ]);

        $middleware->alias([
            'check.permission' => \kiurd\RolePermissions\Middleware\CheckPermission::class,
            'permission' => \Kiurd\RolePermissions\Middleware\PermissionMiddleware::class,


        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
