<?php

namespace App\Services\Permission;

use App\Models\Permission;
use App\Models\Role;

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
        // Fetch all permissions
        $allPermissions = Permission::all();

        // Fetch all roles with their granted permissions
        $roles = Role::with('permissions')->get();

        // Prepare the roles with all permissions (granted and not granted)
        $rolesWithPermissions = $roles->map(function ($role) use ($allPermissions) {
            $rolePermissions = $role->permissions->pluck('id')->toArray();
            $permissions = $allPermissions->mapWithKeys(function ($permission) use ($rolePermissions) {
                return [
                    $permission->name => in_array($permission->id, $rolePermissions),
                ];
            });
            return [
                'role' => $role->name,
                'permissions' => $permissions,
            ];
        });

        return $rolesWithPermissions;
    }
}