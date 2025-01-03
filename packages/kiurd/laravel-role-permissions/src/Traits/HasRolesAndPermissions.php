<?php


namespace kiurd\RolePermissions\Traits;

use Illuminate\Support\Collection;
use kiurd\RolePermissions\Models\Role;
use kiurd\RolePermissions\Models\Permission;

trait HasRolesAndPermissions
{
    public function roles()
    {
        return $this->belongsToMany(
            config('role_permissions.models.role'),
            config('role_permissions.tables.user_roles')
        )->withPivot('guard_name')->withTimestamps();
    }

    public function hasRole($roles, $guard = null)
    {
        if (is_string($roles)) {
            return $this->roles
                ->where('guard_name', $guard ?? $this->getDefaultGuardName())
                ->contains('name', $roles);
        }

        if ($roles instanceof Collection) {
            $roles = $roles->pluck('name')->toArray();
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role, $guard)) {
                    return true;
                }
            }
            return false;
        }

        return false;
    }

    public function assignRole($roles, $guard = null)
    {
        $guard = $guard ?? $this->getDefaultGuardName();

        if (is_string($roles)) {
            $roles = [$roles];
        }

        $roles = collect($roles)->map(function ($role) use ($guard) {
            if (is_string($role)) {
                return config('role_permissions.models.role')::where('name', $role)
                    ->where('guard_name', $guard)
                    ->firstOrFail();
            }

            return $role;
        })->map->id->toArray();

        $this->roles()->syncWithoutDetaching(
            collect($roles)->mapWithKeys(function ($id) use ($guard) {
                return [$id => ['guard_name' => $guard]];
            })->toArray()
        );

        return $this;
    }

    public function removeRole($roles, $guard = null)
    {
        $guard = $guard ?? $this->getDefaultGuardName();

        if (is_string($roles)) {
            $roles = [$roles];
        }

        $roles = collect($roles)->map(function ($role) use ($guard) {
            if (is_string($role)) {
                return config('role_permissions.models.role')::where('name', $role)
                    ->where('guard_name', $guard)
                    ->firstOrFail();
            }

            return $role;
        })->map->id->toArray();

        $this->roles()->detach($roles);

        return $this;
    }

    public function hasPermission($permissionName, $guardName= null)
    {
        $guardName = $guardName ?? $this->getDefaultGuardName();
        return $this->roles()->whereHas('permissions', function ($query) use ($permissionName, $guardName) {
            $query->where('permissions.name', $permissionName)
                ->where('permissions.guard_name', $guardName);
        })->exists();
    }

    public function hasTablePermission($tableName, $action, $guardName = null)
    {
        $guardName = $guardName ?? $this->getDefaultGuardName();

        return $this->roles()
            ->whereHas('permissions', function ($query) use ($tableName, $action, $guardName) {
                $query->where('guard_name', $guardName)
                    ->where(function ($q) use ($tableName, $action) {
                        $q->whereRaw("JSON_CONTAINS(table_names, ?)", ['"' . $tableName . '"'])
                            ->whereRaw("JSON_CONTAINS(actions, ?)", ['"' . $action . '"']);
                    });
            })->exists();
    }

    protected function getDefaultGuardName()
    {
        return 'web';
    }
}
