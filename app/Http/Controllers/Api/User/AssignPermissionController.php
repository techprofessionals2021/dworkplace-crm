<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Permission\AssignPermissionService;
use App\Http\Requests\Permission\AssignPermissionRequest;
use App\Helpers\Response\ResponseHelper;

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
    public function getDepartmentPermissions($department,$role)
    {

        $roleDepartPermissions = $this->assignPermissionService->getSingleDepartmentPermissions($department,$role);
        return ResponseHelper::success([
            'roleDepartPermissions' => $roleDepartPermissions,
        ], 'Permissions Fetched Successfully');
    }


}
