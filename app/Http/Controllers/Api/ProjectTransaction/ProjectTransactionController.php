<?php

namespace App\Http\Controllers\Api\ProjectTransaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project\projectTransaction;
use App\Services\ProjectTransaction\ProjectTransactionService;
use App\Http\Requests\ProjectTransaction\StoreRequest;
use Illuminate\Http\Response;
use App\Helpers\Response\ResponseHelper;

class ProjectTransactionController extends Controller
{

    protected $projectTransactionService;

    public function __construct(ProjectTransactionService $projectTransactionService)
    {
        $this->projectTransactionService = $projectTransactionService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $project_transaction = $this->projectTransactionService->getAllProjectTansactions();
        return ResponseHelper::success($project_transaction, Response::HTTP_OK);

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

    $validatedData=$request->validated();
    $projectTransaction=$this->projectTransactionService->createTransaction($validatedData);
    return ResponseHelper::success($projectTransaction, Response::HTTP_OK);
    
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

        $validated=$request->validated();
        $transaction = $this->projectTransactionService->updateProjectTransaction($id, $validated);
        if (!$transaction) {
            return ResponseHelper::error('Transaction Not Found', Response::HTTP_NOT_FOUND);
        }

        return ResponseHelper::success($transaction, "Transaction Updated Successfully", Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->projectTransactionService->deleteProjectTransaction($id);

        if (!$deleted) {
            return ResponseHelper::error('ProjectTransaction Not Found', Response::HTTP_NOT_FOUND);
        }

        return ResponseHelper::success("ProjectTransaction Deleted Successfully",Response::HTTP_NO_CONTENT);

    }
}
