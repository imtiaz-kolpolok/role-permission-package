<?php

return [
    'models' => [
        'user' => 'App\Models\User',
        'role' => 'kiurd\RolePermissions\Models\Role',
        'module' => 'kiurd\RolePermissions\Models\Module',
        'action' => 'kiurd\RolePermissions\Models\Action',
        'permission' => 'kiurd\RolePermissions\Models\Permission',
        'user_role' => 'kiurd\RolePermissions\Models\UserRole',
        'role_permission' => 'kiurd\RolePermissions\Models\RolePermission',
    ],
    'tables' => [
        'users' => 'users',
        'roles' => 'roles',
        'modules' => 'modules',
        'actions' => 'actions',
        'permissions' => 'permissions',
        'user_roles' => 'user_roles',
        'role_permissions' => 'role_permissions',
    ],
    'guards' => [
        'web',
        'api',
        // Add your guards here
    ]
];
