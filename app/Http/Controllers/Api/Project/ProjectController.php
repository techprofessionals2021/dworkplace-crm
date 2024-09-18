<?php

namespace App\Http\Controllers\Api\Project;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\project\StoreRequest;
use App\Services\Project\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{

    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
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
        $projectData = $request->validated();
        $result = $this->projectService->createProject($projectData);
        
        return ResponseHelper::success($result, 'Project created successfully!',Response::HTTP_CREATED);
        //
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
     * Retrive work types with options
     */
    public function getProjectWorkTypes()
    {  
       $result = $this->projectService->getWorkTypesWithOptions();    
       return ResponseHelper::success($result, 'WorkTypes Retrieved successfully!',Response::HTTP_OK);
    }
}
