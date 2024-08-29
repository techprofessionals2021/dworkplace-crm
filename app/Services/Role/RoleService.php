<?php

namespace App\Services\Role;

use App\Models\Role\Role;

class RoleService
{
    /**
     * Get all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles()
    {
        return Role::all();
    }

    public function createRole(array $data)
    {
        return Role::create($data);
    }

    public function updateRole(array $data, int $id)
    {
        $role = Role::findOrFail($id);
        $role->update($data);
        return $role;
    }

    public function getPermissionsByRoleId($roleId)
    {
        $role = Role::with('permissions')->find($roleId);

        if (!$role) {
            return null;
        }

        return $role;
    }
}