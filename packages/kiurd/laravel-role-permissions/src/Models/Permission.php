<?php

namespace kiurd\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['module_id', 'action_id', 'guard_name'];

    public function module()
    {
        return $this->belongsTo(
            config('role_permissions.models.module'),
            'module_id'
        );
    }

    public function action()
    {
        return $this->belongsTo(
            config('role_permissions.models.action'),
            'action_id'
        );
    }

    public function roles()
    {
        return $this->belongsToMany(
            config('role_permissions.models.role'),
            config('role_permissions.tables.role_permissions')
        )->withPivot('guard_name')->withTimestamps();
    }
}
