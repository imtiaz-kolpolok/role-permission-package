<?php

namespace kiurd\RolePermissions\Facades;

use Illuminate\Support\Facades\Facade;

class RolePermissionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'role-permissions';
    }
}
