<?php

namespace App\Services\Permission;

use App\Models\Permission;
use App\Models\Role\Role;

class AssignPermissionService
{
    /**
     * Assign permissions to a role.
     *
     * @param int $roleId
     * @param array $permissionIds
     * @return Role
     */
    public function assignPermissions(int $roleId, array $permissionIds): Role
    {
        // Find the role
        $role = Role::findOrFail($roleId);


        // Sync the permissions to the role
        $role->permissions()->sync($permissionIds);

        // Return the role with its permissions
        return $role->load('permissions');
    }

    public function getRolesWithPermissions()
    {
        // Fetch all roles with their granted permissions
        $roles = Role::with('permissions')->get();

        // Prepare the roles with their permissions
        $rolesWithPermissions = $roles->map(function ($role) {
            return [
                'role' => $role->name,  // Return role as an array
                'permissions' => $role->permissions->pluck('name')->toArray(),  // Return permissions as an array of names
            ];
        });

        return $rolesWithPermissions;

    }
}