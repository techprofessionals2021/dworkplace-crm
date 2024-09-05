<?php

namespace App\Http\Controllers\Api\DirectClient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\DirectClient\StoreRequest;
use App\Http\Resources\DirectClient\DirectClientResource;
use App\Services\DirectClient\DirectClientService;

class DirectClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $directClientService;
    public function __construct(DirectClientService $directClientService)
    {
        $this->directClientService = $directClientService;
    }

    public function index()
    {
        $directClients = $this->directClientService->getAllDirectClients();
        $directClientsResource = DirectClientResource::collection($directClients);
        return ResponseHelper::success($directClientsResource, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validate = $request->validated();
        $directClient = $this->directClientService->createDirectClient($validate);
        $directClientResource = new DirectClientResource($directClient);
        return ResponseHelper::success($directClientResource, "Direct Client Created Successfully", Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $directClient = $this->directClientService->findDirectClientById($id);

        if(!$directClient){
            return ResponseHelper::error('Direct Client Not Found', Response::HTTP_NOT_FOUND);
        }
        else{
            $directClientResource = new DirectClientResource($directClient);
            return ResponseHelper::success($directClientResource, "Client Fetched Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $validate = $request->validated();
        $directClient = $this->directClientService->updateDirectClient($validate, $id);
        if(!$directClient){
            return ResponseHelper::error('Direct Client Not Found', Response::HTTP_NOT_FOUND);
        } else {
            $directClientResource = new DirectClientResource($directClient);
            return ResponseHelper::success($directClientResource, "Direct Client Updated Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->directClientService->deleteDirectClient($id);

        if(!$deleted){
            return ResponseHelper::error('Direct Client Not Found', Response::HTTP_NOT_FOUND);
        } else {
            return ResponseHelper::success(null, "Direct Client Deleted Successfully", Response::HTTP_NO_CONTENT);
        }
    }
}
