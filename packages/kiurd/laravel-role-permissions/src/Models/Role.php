<?php

namespace kiurd\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'guard_name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(
            config('role_permissions.models.permission'),
            config('role_permissions.tables.role_permissions')
        )->withPivot('guard_name')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(
            config('role_permissions.models.user'),
            config('role_permissions.tables.user_roles')
        )->withPivot('guard_name')->withTimestamps();
    }

    public function givePermissionTo($permission)
    {
        return $this->permissions()->syncWithoutDetaching([$permission->id => [
            'guard_name' => $permission->guard_name
        ]]);
    }

    public function syncPermissions($permissions)
    {
        $this->permissions()->sync(
            collect($permissions)->map(function($permission) {
                return ['permission_id' => $permission->id, 'guard_name' => $permission->guard_name];
            })
        );
        return $this;
    }
}
