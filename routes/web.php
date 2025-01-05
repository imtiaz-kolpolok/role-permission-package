<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/role-permission', function () {
//    $user = User::create([
//        'name' => 'Admin',
//        'email' => 'example@gmail.com',
//        'password' => bcrypt('123456')
//    ]);
    $user = User::find(1);
//    $role = kiurd\RolePermissions\Models\Role::create(['name' => 'admin', 'description' => 'Admin Role']);
    $role = kiurd\RolePermissions\Models\Role::where('name', 'admin')->first();

//    $permission = kiurd\RolePermissions\Models\Permission::insert([
//        ['name' => 'create', 'guard_name' => 'web', 'table_names' => 'users'],
//        ['name' => 'read', 'guard_name' => 'web', 'table_names' => 'users'],
//        ['name' => 'update', 'guard_name' => 'web', 'table_names' => 'users'],
//        ['name' => 'delete', 'guard_name' => 'web', 'table_names' => 'users'],
//    ]);
//
    $permission = kiurd\RolePermissions\Models\Permission::where('name', 'create')->first();

//    $role->permissions()->attach($permission->id);
//    $user->assignRole('admin');

//    dd($user->hasRole('admin'));
    dd($user->hasPermission('create'));
//    $user->hasTablePermission('posts', 'create');


    return 'Role and Permission created successfully';
});

Route::get('/role-permission-assign', function () {
    $user = User::first();

    if (!$user) {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'example@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }

    $role = \kiurd\RolePermissions\Models\Role::where('name', 'admin')->first();

    if (!$role) {
        $role = \kiurd\RolePermissions\Models\Role::create(['name' => 'admin', 'description' => 'Admin Role']);
    }

    $modules = ['users', 'roles', 'permissions', 'posts', 'categories'];

    foreach ($modules as $module) {
        $new_module = \kiurd\RolePermissions\Models\Module::where('name', $module)->first();
        if (!$new_module) {
            \kiurd\RolePermissions\Models\Module::create(['name' => $module, 'guard_name' => 'web']);
        }
    }


    $action = ['create', 'read', 'update', 'delete', 'restore', 'forceDelete'];

    foreach ($action as $act) {
        $new_action = \kiurd\RolePermissions\Models\Action::where('name', $act)->first();
        if (!$new_action) {
            $action = \kiurd\RolePermissions\Models\Action::create(['name' => $act, 'guard_name' => 'web']);

            foreach ($modules as $module) {
                $module = \kiurd\RolePermissions\Models\Module::where('name', $module)->first();
                $action->actionSyncToModule($module);
            }

        }else{
            foreach ($modules as $module) {
                $module = \kiurd\RolePermissions\Models\Module::where('name', $module)->first();
                $new_action->actionSyncToModule($module);
            }
        }
    }

    $permissions = \kiurd\RolePermissions\Models\Permission::all();
    foreach ($permissions as $permission) {
        $role->givePermissionTo($permission);
    }

    $user->assignRole('admin');

    return 'Role and Permission assigned successfully';
});

Route::get('/check-permission', function () {
    $user = User::first();

    if ($user->hasPermission('users', 'create')) {
        // User has permission
        return 'User has permission';
    }else{
        // User has no permission
        return 'User has no permission';
    }
});

Route::middleware(['check.permission:users,create'])->group(function () {
    // Protected routes
    Route::get('/protected', function () {
        return 'Protected route';
    });
});
