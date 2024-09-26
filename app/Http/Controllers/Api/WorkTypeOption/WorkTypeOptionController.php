<?php

namespace App\Http\Controllers\Api\WorkTypeOption;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Http\Response;
use App\Http\Resources\WorkTypeOption\WorkTypeOptionResource;
use App\Http\Requests\WorkTypeOption\StoreRequest;
use App\Services\WorkTypeOption\WorkTypeOptionService;
use App\Models\WorkTypeOption\WorkTypeOption;

class WorkTypeOptionController extends Controller
{
    protected $workTypeOptionService;
    public function __construct(WorkTypeOptionService $workTypeOptionService)
    {
        $this->workTypeOptionService = $workTypeOptionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $workTypeOptions = $this->workTypeOptionService->getAllWorkTypeOptions();
        $allWorkTypeOptions = WorkTypeOptionResource::collection($workTypeOptions);
        return ResponseHelper::success($allWorkTypeOptions, "Work Type Options Fetched Successfully", Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validate = $request->validated();
        $workTypeOption = $this->workTypeOptionService->createWorkTypeOption($validate);
        $workTypeOptionResource = new WorkTypeOptionResource($workTypeOption);
        return ResponseHelper::success($workTypeOptionResource, "Work Type Option Created Successfully", Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workTypeOption = $this->workTypeOptionService->findWorkTypeOptionById($id);

        if(!$workTypeOption){
            return ResponseHelper::error('Work Type Option Not Found', Response::HTTP_NOT_FOUND);
        }
        else{
            $workTypeOptionResource = new WorkTypeOptionResource($workTypeOption);
            return ResponseHelper::success($workTypeOptionResource, "Work Type Option Fetched Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $validate = $request->validated();
        $workTypeOption = $this->workTypeOptionService->updateWorkTypeOption($validate, $id);

        if(!$workTypeOption){
            return ResponseHelper::error('Work Type Option Not Found', Response::HTTP_NOT_FOUND);
        }
        else{
            $workTypeOptionResource = new WorkTypeOptionResource($workTypeOption);
            return ResponseHelper::success($workTypeOptionResource, "Work Type Option Updated Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workTypeOption = $this->workTypeOptionService->deleteWorkTypeOption($id);
        if(!$workTypeOption){
            return ResponseHelper::error('Work Type Option Not Found', Response::HTTP_NOT_FOUND);
        }
        else{
            return ResponseHelper::success(null, "Work Type Option Deleted Successfully", Response::HTTP_OK);
        }
    }

    public function filterWorkTypeOptions($id)
{

    $worktypeOptions = WorkTypeOption::where('work_type_id', $id)->get();
    return ResponseHelper::success($worktypeOptions, "Specific Work Type Options  Fetched Successfully", Response::HTTP_OK);
}

}
