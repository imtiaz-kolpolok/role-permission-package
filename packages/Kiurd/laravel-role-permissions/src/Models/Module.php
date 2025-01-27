<?php

namespace Kiurd\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name', 'guard_name', 'description'];

    public function permissions()
    {
        return $this->hasMany(
            config('role_permissions.models.permission'),
            'module_id'
        );
    }

    public function actions()
    {
        return $this->belongsToMany(
            config('role_permissions.models.action'),
            config('role_permissions.tables.permissions'),
            'module_id',
            'action_id'
        )->withPivot('id', 'guard_name')->withTimestamps();
    }

    public function moduleAssignToActions($action)
    {
        $this->actions()->sync($action);
    }
}
