<?php

namespace kiurd\RolePermissions\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RolePermission extends Pivot
{
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('role_permissions.tables.role_permissions');
    }

    protected $fillable = [
        'role_id',
        'permission_id',
        'guard_name'
    ];

    public function role()
    {
        return $this->belongsTo(
            config('role_permissions.models.role'),
            'role_id'
        );
    }

    public function permission()
    {
        return $this->belongsTo(
            config('role_permissions.models.permission'),
            'permission_id'
        );
    }
}
