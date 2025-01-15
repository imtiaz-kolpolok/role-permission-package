<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tableNames = config('role_permissions.tables');

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('guard_name')->default('web');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['modules'], function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('guard_name')->default('web');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['actions'], function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('guard_name')->default('web');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['permissions'], function (Blueprint $table) use ($tableNames) {
            $table->id();
            $table->foreignId('module_id')->constrained($tableNames['modules'])->onDelete('cascade');
            $table->foreignId('action_id')->constrained($tableNames['actions'])->onDelete('cascade');
            $table->string('guard_name')->default('web');
            $table->timestamps();

            $table->unique(['module_id', 'action_id', 'guard_name']);
        });

        Schema::create($tableNames['role_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->id();
            $table->foreignId('role_id')->constrained($tableNames['roles'])->onDelete('cascade');
            $table->foreignId('permission_id')->constrained($tableNames['permissions'])->onDelete('cascade');
            $table->string('guard_name')->default('web');
            $table->timestamps();

            $table->unique(['role_id', 'permission_id', 'guard_name']);
        });

        Schema::create($tableNames['user_roles'], function (Blueprint $table) use ($tableNames) {
            $table->id();
            $table->foreignId('user_id')->constrained($tableNames['users'])->onDelete('cascade');
            $table->foreignId('role_id')->constrained($tableNames['roles'])->onDelete('cascade');
            $table->string('guard_name')->default('web');
            $table->timestamps();

            $table->unique(['user_id', 'role_id', 'guard_name']);
        });
    }

    public function down()
    {
        $tableNames = config('role_permissions.tables');

        Schema::dropIfExists($tableNames['user_roles']);
        Schema::dropIfExists($tableNames['role_permissions']);
        Schema::dropIfExists($tableNames['permissions']);
        Schema::dropIfExists($tableNames['actions']);
        Schema::dropIfExists($tableNames['modules']);
        Schema::dropIfExists($tableNames['roles']);}
};
