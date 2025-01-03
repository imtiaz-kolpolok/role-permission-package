<?php

namespace kiurd\RolePermissions\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    protected $table = 'user_roles';

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
