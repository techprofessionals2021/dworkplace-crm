<?php

namespace App\Http\Controllers\Api\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\DepartmentPermission\AssignDepartmentPermissionRequest;
use App\Services\DepartmentPermission\DepartmentPermissionService;
class DepartmentPermissionController extends Controller
{
    protected $departmentPermissionService;

    public function __construct(DepartmentPermissionService $departmentPermissionService)
    {
        $this->departmentPermissionService = $departmentPermissionService;
    }


    public function index()
    {
        // Call the service method to get all records
        $records = $this->departmentPermissionService->getAllRolePermissionDepartmentRecords();

        // Return a successful response using the ResponseHelper
        return ResponseHelper::success($records, 'Role-Permission-Department records retrieved successfully');
    }

    public function store(AssignDepartmentPermissionRequest $request)
    {
        $validated = $request->validated();

        $rolePermissionDepartment = $this->departmentPermissionService->assignPermissionToDepartment(
            $validated['role_id'],
            $validated['permission_ids'],
            $validated['department_id']
        );

        return ResponseHelper::success($rolePermissionDepartment, 'Role Permission assigned to department successfully');

    }
}
