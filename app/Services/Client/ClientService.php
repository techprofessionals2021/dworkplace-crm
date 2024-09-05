<?php

namespace App\Services\Client;
use App\Models\Client\Client;

class ClientService
{
    public function getAllClients()
    {
        return Client::all();
    }

    public function createClient($data)
    {
        return Client::create($data);
    }

    public function getClientById($id)
    {
        return Client::find($id);
    }

    public function updateClientById($data, $id)
    {
        $client = $this->getClientById($id);
        if(!$client){
            return null;
        }
        else {
            $client->update($data);
            return $client;
        }
    }

    public function deleteClientById($id)
    {
        $client = $this->getClientById($id);
        if(!$client){
            return null;
        }
        else{
            return $client->delete();
        }
    }
}
