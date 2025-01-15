<?php

namespace Kiurd\RolePermissions\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('role_permissions.tables.user_roles');
    }

    protected $fillable = [
        'user_id',
        'role_id',
        'guard_name'
    ];

    public function user()
    {
        return $this->belongsTo(
            config('role_permissions.models.user'),
            'user_id'
        );
    }

    public function role()
    {
        return $this->belongsTo(
            config('role_permissions.models.role'),
            'role_id'
        );
    }
}
