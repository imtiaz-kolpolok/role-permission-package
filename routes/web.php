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
