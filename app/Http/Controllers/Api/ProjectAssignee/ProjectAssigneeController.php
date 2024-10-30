<?php

namespace App\Http\Controllers\Api\ProjectAssignee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectAssignee\projectAssignee;
use App\Services\ProjectAssignee\ProjectAssigneeService;
use Illuminate\Http\Response;
use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\ProjectAssignee\StoreRequest;

class ProjectAssigneeController extends Controller
{

    protected $projectAssigneeService;

    public function __construct(ProjectAssigneeService $projectAssigneeService)
    {
        $this->projectAssigneeService = $projectAssigneeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreRequest $request)
    {

        $validated= $request->validated();
        $project_assignee =  $this->projectAssigneeService->AssignProject($validated);

        return ResponseHelper::success($project_assignee, 'Project has been assigned successfully');
    }

    /**
     * Display the specified resource
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
}
