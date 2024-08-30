<?php

namespace App\Services\Permission;

use App\Http\Resources\Permission\PermissionResource;
use App\Http\Resources\Status\StatusResource;
use App\Models\Permission\Permission;
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

    public function getAllPermissions()
    {
        $records = \App\Models\Permission\Permission::get();

        return PermissionResource::collection($records);
    }

    public function getSingleDepartmentPermissions($department_id,$role_id)
    {
        
        return Permission::join('role_permission_departments', 'permissions.id', '=', 'role_permission_departments.permission_id')
        ->join('roles', 'role_permission_departments.role_id', '=', 'roles.id')
        ->where('roles.id', $role_id)
        ->where('role_permission_departments.department_id', $department_id)
        ->select('permissions.*')
        ->get();
    }
}