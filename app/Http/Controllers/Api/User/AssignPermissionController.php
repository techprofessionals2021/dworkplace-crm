<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Permission\AssignPermissionService;
use App\Http\Requests\Permission\AssignPermissionRequest;
use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\DepartmentPermission\AssignDepartmentPermissionRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AssignPermissionController extends Controller
{

    protected $assignPermissionService;

    /**
     * AssignPermissionController constructor.
     */
    public function __construct(AssignPermissionService $assignPermissionService)
    {
        $this->assignPermissionService = $assignPermissionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $rolesWithPermissions = $this->assignPermissionService->getRolesWithPermissions();

        // return ResponseHelper::success($rolesWithPermissions, 'Roles with permissions retrieved successfully');

        $rolesWithPermissions = $this->assignPermissionService->getAllPermissions();

        return ResponseHelper::success($rolesWithPermissions, 'Permissions retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignPermissionRequest $request)
    {
        // Retrieve the validated data from the request
        $validated = $request->validated();

        // Use the service to assign permissions
        $role = $this->assignPermissionService->assignPermissions($validated['role_id'], $validated['permission_ids']);

        return ResponseHelper::success([
            'role' => $role,
        ], 'Permissions assigned successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * get role permissions according to department
     */
    public function getDepartmentPermissions($department, $role)
    {

        $roleDepartPermissions = $this->assignPermissionService->getSingleDepartmentPermissions($department, $role);
        return ResponseHelper::success([
            'roleDepartPermissions' => $roleDepartPermissions,
        ], 'Permissions Fetched Successfully');
    }

    /**
     * store role permissions according to department
     */
    public function updateDepartmentPermissions(AssignDepartmentPermissionRequest $request)
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
