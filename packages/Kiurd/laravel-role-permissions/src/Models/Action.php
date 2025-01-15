<?php

namespace Kiurd\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['name', 'guard_name', 'description'];

    public function permissions()
    {
        return $this->hasMany(
            config('role_permissions.models.permission'),
            'action_id'
        );
    }

    public function modules()
    {
        return $this->belongsToMany(
            config('role_permissions.models.module'),
            config('role_permissions.tables.permissions'),
            'action_id',
            'module_id'
        )->withPivot('id', 'guard_name')->withTimestamps();
    }

    public function actionSyncToModule($module)
    {
        return $this->modules()->syncWithoutDetaching([$module->id => [
            'guard_name' => $module->guard_name
        ]]);
    }
}
