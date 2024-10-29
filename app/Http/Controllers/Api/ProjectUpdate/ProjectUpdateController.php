<?php

namespace App\Http\Controllers\Api\ProjectUpdate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\ProjectUpdate\StoreRequest;
use App\Services\ProjectUpdate\ProjectUpdateService;

class ProjectUpdateController extends Controller
{
    protected $projectUpdateService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(ProjectUpdateService $projectUpdateService){
        $this->projectUpdateService = $projectUpdateService;
    }


    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $projectUpdate = $this->projectUpdateService->createProjectUpdate($data);

        return ResponseHelper::success($projectUpdate, "Project Update Created Successfully", Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $data = $request->validated();
        $projectUpdate = $this->projectUpdateService->updateProjectUpdate($data, $id);
        if(!$projectUpdate){
            return ResponseHelper::error('Project Update Not Found', Response::HTTP_NOT_FOUND);
        } else{
            return ResponseHelper::success($projectUpdate, "Project Update Updateed Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->projectUpdateService->deleteProjectUpdate($id);
        if(!$response){
            return ResponseHelper::error('Project Update Not Found', Response::HTTP_NOT_FOUND);
        }
        return ResponseHelper::success(null, "Project Update Deleted Successfully",Response::HTTP_NO_CONTENT);
    }
}
