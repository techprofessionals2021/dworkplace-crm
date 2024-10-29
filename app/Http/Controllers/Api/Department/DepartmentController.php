<?php

namespace App\Http\Controllers\Api\Department;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Department\StoreRequest;
use App\Http\Resources\Department\DepartmentResource;
use App\Services\Department\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = $this->departmentService->getAllDepartments();
        $departments = DepartmentResource::collection($departments);
        return ResponseHelper::success($departments, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $validated = $request->validated();
        $department = $this->departmentService->createDepartment($validated);
        return ResponseHelper::success($department, "Department Created Successfully", Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = $this->departmentService->getDepartmentById($id);

        if (!$department) {
            return ResponseHelper::error('Department Not Found', Response::HTTP_NOT_FOUND);
        }

        $department_resource = new DepartmentResource($department);
        return ResponseHelper::success($department, "Department Fetched Successfully", Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {

        $validated = $request->validated();
        $department = $this->departmentService->updateDepartment($id, $validated);

        if (!$department) {
            return ResponseHelper::error('Department Not Found', Response::HTTP_NOT_FOUND);
        }

        return ResponseHelper::success($department, "Department Updated Successfully", Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->departmentService->deleteDepartment($id);

        if (!$deleted) {
            return ResponseHelper::error('Department Not Found', Response::HTTP_NOT_FOUND);
        }

        return ResponseHelper::success(null, "Department Deleted Successfully",Response::HTTP_NO_CONTENT);
    }
}
