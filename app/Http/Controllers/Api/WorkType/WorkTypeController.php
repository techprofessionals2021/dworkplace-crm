<?php

namespace App\Http\Controllers\Api\WorkType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Http\Requests\WorkType\StoreRequest;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Http\Response;
use App\Services\WorkType\WorkTypeService;
use App\Http\Resources\WorkType\WorkTypeResource;

class WorkTypeController extends Controller
{
    protected $workTypeService;

    public function __construct(WorkTypeService $workTypeService)
    {
        $this->workTypeService = $workTypeService;
    }

    public function index()
    {
        $workType = $this->workTypeService->getAllWorkTypes();
        $allWorkTypes = WorkTypeResource::collection($workType);
        return ResponseHelper::success($allWorkTypes, 'WorkTypes retrieved successfully');

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
         $workType= $this->workTypeService->createWorkType($request->validated());
         return ResponseHelper::success($workType, 'WorkType created successfully');
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
    public function update(StoreRequest $request, string $id)
    {
        $workType = $this->workTypeService->updateWorkType($request->validated(), (int) $id);
        return ResponseHelper::success($workType, 'WorkType updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     
        $deleted = $this->workTypeService->deleteWorkType($id);

        if (!$deleted) {
            return ResponseHelper::error('WorkType not found', Response::HTTP_NOT_FOUND);
        }

        return ResponseHelper::success("WorkType deleted successfully",Response::HTTP_NO_CONTENT);
    }
}
