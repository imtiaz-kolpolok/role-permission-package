<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Kiurd\RolePermissions\Models\Action;
use Kiurd\RolePermissions\Models\Module;
use Kiurd\RolePermissions\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('create-user', function () {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
    })->middleware('permission:create');

    Route::get('create-role', function () {
        Role::create([
            'name' => 'Admin',
            'description' => 'Admin Role'
        ]);
    })->middleware('permission:create');

    Route::get('create-module', function (){
        Module::create([
            'name' => 'Admin',
            'description' => 'Admin Module'
        ]);
    });

    Route::get('create-action', function (){
        Action::create([
            'name' => 'Admin',
            'description' => 'Admin Action'
        ]);
    });

    Route::get('create-permission', function (){
        $module = Module::find(1);
        $module->moduleAssignToActions([1,2,3]);
    });

    Route::get('create-role-permission', function (){
        $role = Role::find(1);
        $role->assignPermissions([1,2,3]);
    });

    Route::get('test-permission', function (){
        dump(auth()->user());
        dd(auth()->user()->hasPermission('users','create'));
    });


    Route::get('test-index',[\App\Http\Controllers\TestController::class,'index']);
    Route::get('test-create',[\App\Http\Controllers\TestController::class,'create']);



});

require __DIR__.'/auth.php';
