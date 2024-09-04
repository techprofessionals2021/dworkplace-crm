<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Response\ResponseHelper;
use App\Services\Client\ClientService;
use App\Http\Requests\Client\StoreRequest;
use App\Http\Resources\Client\ClientResource;

class ClientController extends Controller
{
    protected $clientService;
    public function __construct(ClientService $clientService){
        $this->clientService = $clientService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = $this->clientService->getAllClients();
        $allClients = ClientResource::collection($clients);
        return ResponseHelper::success($allClients, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validate = $request->validated();
        $client = $this->clientService->createClient($validate);
        $clientResource = new ClientResource($client);
        return ResponseHelper::success($clientResource, "Client Created Successfully", Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = $this->clientService->getClientById($id);
        if(!$client)
        {
            return ResponseHelper::error('Client Not Found', Response::HTTP_NOT_FOUND);
        }
        else {
            $clientResource = new ClientResource($client);
            return ResponseHelper::success($clientResource, "Client Fetched Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $validate = $request->validated();
        $client = $this->clientService->updateClientById($validate, $id);

        if(!$client){
            return ResponseHelper::error('Client Not Found', Response::HTTP_NOT_FOUND);
        } else {
            $clientResource = new ClientResource($client);
            return ResponseHelper::success($clientResource, "Client Updated Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->clientService->deleteClientById($id);
        if(!$deleted){
            return ResponseHelper::error('Client Not Found', Response::HTTP_NOT_FOUND);
        } else {
            return ResponseHelper::success(null, "Client Deleted Successfully", Response::HTTP_NO_CONTENT);
        }
    }
}
