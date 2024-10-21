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
        $roleWithPermissions = Role::with('permissions')->find($roleId);

        if (!$roleWithPermissions) {
            return null;
        }

        return $roleWithPermissions;
    }

    public function getRolePermissions()
    {
        return Role::with('permissions:id')->get()->map(function ($role) {
            return (object) [
                'role_id' => $role->id,
                'permission_ids' => $role->permissions->pluck('id')->toArray(),
            ];
        })->values()->toArray();
    }
}
