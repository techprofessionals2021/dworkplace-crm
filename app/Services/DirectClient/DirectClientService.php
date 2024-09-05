<?php

namespace App\Services\DirectClient;
use App\Models\DirectClient\DirectClient;

class DirectClientService
{
    public function getAllDirectClients()
    {
        return DirectClient::all();
    }

    public function createDirectClient($data)
    {
        return DirectClient::create($data);
    }

    public function findDirectClientById($id)
    {
        return DirectClient::find($id);
    }

    public function updateDirectClient($data, $id)
    {
        $client = $this->findDirectClientById($id);
        if(!$client){
            return null;
        }
        else {
            $client->update($data);
            return $client;
        }
    }

    public function deleteDirectClient($id)
    {
        $client = $this->findDirectClientById($id);
        if(!$client){
            return null;
        }
        else{
            return $client->delete();
        }
    }
}
