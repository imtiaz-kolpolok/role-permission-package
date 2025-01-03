<?php

namespace kiurd\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'guard_name', 'table_names', 'actions'];

    protected $casts = [
        'table_names' => 'array',
        'actions' => 'array'
    ];

    public function roles()
    {
        return $this->belongsToMany(
            config('role_permissions.models.role'),
            config('role_permissions.tables.role_permissions')
        )->withPivot('guard_name')->withTimestamps();
    }
}
