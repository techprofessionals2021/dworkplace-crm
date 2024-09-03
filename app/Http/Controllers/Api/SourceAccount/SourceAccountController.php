<?php

namespace App\Http\Controllers\Api\SourceAccount;

use Illuminate\Http\Request;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Response;
use App\Http\Requests\SourceAccount\StoreRequest;
use App\Services\SourceAccount\SourceAccountService;
use App\Http\Resources\SourceAccount\SourceAccountResource;

class SourceAccountController extends Controller
{
    protected $sourceAccountService;

    public function __construct(SourceAccountService $sourceAccountService)
    {
        $this->sourceAccountService = $sourceAccountService;
    }

    public function index()
    {
        $sourceAccount = $this->sourceAccountService->getAllSourceAccount();
        $allSourceAccount= SourceAccountResource::collection($sourceAccount);
        return ResponseHelper::success($allSourceAccount, 'Source Account retrieved successfully');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
         $sourceAccount= $this->sourceAccountService->createSourceAccount($request->validated());
         return ResponseHelper::success($sourceAccount, 'SourceAccount created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $sourceAccount = $this->sourceAccountService->updateSourceAccount($request->validated(), (int) $id);
        return ResponseHelper::success($sourceAccount, 'Source Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     
        $deleted = $this->sourceAccountService->deleteSourceAccount($id);

        if (!$deleted) {
            return ResponseHelper::error('SourceAccount not found', Response::HTTP_NOT_FOUND);
        }

        return ResponseHelper::success("SourceAccount deleted successfully",Response::HTTP_NO_CONTENT);
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}
