<?php

namespace App\Http\Controllers\APi\UserTarget;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserTarget\UserTargetService;
use App\Http\Resources\UserTarget\UserTargetResource;
use App\Http\Requests\UserTarget\StoreRequest;
use App\Helpers\Response\ResponseHelper;

class UserTargetController extends Controller
{
    protected $userTargetService;

    public function __construct(UserTargetService $userTargetService){
        $this->userTargetService = $userTargetService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userTargets = $this->userTargetService->getAllUserTargets();
        $allUserTargets = UserTargetResource::collection($userTargets);
        return ResponseHelper::success($allUserTargets, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $userTarget = $this->userTargetService->createUserTarget($data);
        return ResponseHelper::success($userTarget, "User Target Created Successfully", Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userTarget = $this->userTargetService->getUserTargetById($id);
        if(!$userTarget){
            return ResponseHelper::error('User Target Not Found', Response::HTTP_NOT_FOUND);
        } else {
            $targetResource = new UserTargetResource($userTarget);
            return ResponseHelper::success($targetResource, "User Target Fetched Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $data = $request->validated();
        $userTarget = $this->userTargetService->updateUserTarget($id, $data);
        if(!$userTarget){
            return ResponseHelper::error('User Target Not Found', Response::HTTP_NOT_FOUND);
        } else {
            return ResponseHelper::success($userTarget, "User Target Updated Successfully.", Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userTarget = $this->userTargetService->deleteUserTarget($id);
        if(!$userTarget){
            return ResponseHelper::error('User Target Not Found', Response::HTTP_NOT_FOUND);
        } else {
            return ResponseHelper::success(null, "User Target Deleted Successfully",Response::HTTP_NO_CONTENT);
        }
    }
}
