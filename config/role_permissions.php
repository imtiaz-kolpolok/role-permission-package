<?php

return [
    'models' => [
        'user' => 'App\Models\User',
        'role' => 'kiurd\RolePermissions\Models\Role',
        'permission' => 'kiurd\RolePermissions\Models\Permission',
        'user_role' => 'kiurd\RolePermissions\Models\UserRole',
        'role_permission' => 'kiurd\RolePermissions\Models\RolePermission',
    ],
    'tables' => [
        'users' => 'users',
        'roles' => 'roles',
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
