<?php

return [
    'models' => [
        'user' => 'App\Models\User',
        'role' => 'Kiurd\RolePermissions\Models\Role',
        'module' => 'Kiurd\RolePermissions\Models\Module',
        'action' => 'Kiurd\RolePermissions\Models\Action',
        'permission' => 'Kiurd\RolePermissions\Models\Permission',
        'user_role' => 'Kiurd\RolePermissions\Models\UserRole',
        'role_permission' => 'Kiurd\RolePermissions\Models\RolePermission',
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
