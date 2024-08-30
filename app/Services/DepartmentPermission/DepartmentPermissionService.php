<?php

namespace App\Services\DepartmentPermission;


use App\Helpers\Response\ResponseHelper;
use App\Models\Permission\Permission;
use App\Models\RolePermissionDepartment\RolePermissionDepartment;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class DepartmentPermissionService
{
    public function getSingleDepartmentPermissions($department_id, $role_id)
    {

        return Permission::join('role_permission_departments', 'permissions.id', '=', 'role_permission_departments.permission_id')
            ->join('roles', 'role_permission_departments.role_id', '=', 'roles.id')
            ->where('roles.id', $role_id)
            ->where('role_permission_departments.department_id', $department_id)
            ->select('permissions.*')
            ->get();
    }


    public function updateDepartmentPermissions($request)
    {

        // Prepare the data for insertion
        $data = array_map(function ($permission) use ($request) {
            return [
                'role_id' => $request->role_id,
                'permission_id' => $permission,
                'department_id' => $request->department_id,
            ];
        }, $request->permission_ids);

        try {
            DB::transaction(function () use ($data, $request) {
                // Delete existing permissions
                DB::table('role_permission_departments')
                    ->where('role_id', $request->role_id)
                    ->where('department_id', $request->department_id)
                    ->delete();

                // Insert new permissions
                DB::table('role_permission_departments')->insert($data);
            });

            return ResponseHelper::success([], 'Permissions Assigned Successfully');
        } catch (QueryException $e) {
            // Handle database-specific exceptions
            return ResponseHelper::error('Database error occurred: ' . $e->getMessage(), 500);
        } catch (\Exception $e) {
            // Handle other exceptions
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
