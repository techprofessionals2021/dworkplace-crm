<?php

namespace App\Http\Controllers\Api\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\DepartmentPermission\AssignDepartmentPermissionRequest;
use App\Services\DepartmentPermission\DepartmentPermissionService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class DepartmentPermissionController extends Controller
{
    protected $departmentPermissionService;

    public function __construct(DepartmentPermissionService $departmentPermissionService)
    {
        $this->departmentPermissionService = $departmentPermissionService;
    }


    /**
     * get role permissions according to department
     */
    public function getDepartmentPermissions($department, $role)
    {

        $roleDepartPermissions = $this->departmentPermissionService->getSingleDepartmentPermissions($department, $role);
        return ResponseHelper::success([
            'roleDepartPermissions' => $roleDepartPermissions,
        ], 'Permissions Fetched Successfully');
    }

    /**
     * store role permissions according to department
     */
    public function updateDepartmentPermissions(AssignDepartmentPermissionRequest $request)
    {
        return $this->departmentPermissionService->updateDepartmentPermissions($request);
    }
}
