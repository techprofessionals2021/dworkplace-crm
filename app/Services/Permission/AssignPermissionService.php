<?php

namespace App\Services\Permission;

use App\Models\Permission;
use App\Models\Role\Role;
use App\Models\RolePermissionDepartment\RolePermissionDepartment;

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
        $records = RolePermissionDepartment::with(['role', 'permission', 'department'])->get();

        return $records;


    }
}