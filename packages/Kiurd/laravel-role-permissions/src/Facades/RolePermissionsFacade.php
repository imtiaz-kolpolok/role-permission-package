<?php

namespace Kiurd\RolePermissions\Facades;

use Illuminate\Support\Facades\Facade;

class RolePermissionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'role-permissions';
    }
}
