<?php

namespace Kiurd\RolePermissions;

use Illuminate\Support\ServiceProvider;
use Kiurd\RolePermissions\Models\Permission;
use Kiurd\RolePermissions\Models\Role;
use Kiurd\RolePermissions\Facades\RolePermissionsFacade;

class RolePermissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/role_permissions.php' => config_path('role_permissions.php'),
        ], 'role-permissions-config');

        $this->publishes([
            __DIR__.'/database/migrations/create_role_permission_tables.php' =>
                database_path('migrations/'.date('Y_m_d_His', time()).'_create_permission_tables.php'),
        ], 'role-permissions-migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/role_permissions.php', 'role_permissions'
        );
    }
}
