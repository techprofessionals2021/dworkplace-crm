<?php

namespace App\Services\DepartmentPermission;


use App\Helpers\Response\ResponseHelper;
use App\Models\RolePermissionDepartment\RolePermissionDepartment;

class DepartmentPermissionService
{
    public function assignPermissionToDepartment($roleId, $permissionIds, $departmentId)
    {
        $assignedPermissions = collect();

        foreach ($permissionIds as $permissionId) {
            $rolePermissionDepartment = RolePermissionDepartment::updateOrCreate(
                [
                    'role_id' => $roleId,
                    'permission_id' => $permissionId,
                    'department_id' => $departmentId,
                ]
            );

            $assignedPermissions->push($rolePermissionDepartment->load(['role', 'permission', 'department']));
        }

        return $assignedPermissions;


    }


    public function getAllRolePermissionDepartmentRecords()
    {
        $records = RolePermissionDepartment::with(['role', 'permission', 'department'])->get();

        return ResponseHelper::success($records, 'Role-Permission-Department records retrieved successfully');
    }

}