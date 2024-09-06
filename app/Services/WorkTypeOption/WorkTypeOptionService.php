<?php

namespace App\Services\WorkTypeOption;

use App\Models\WorkTypeOption\WorkTypeOption;

class WorkTypeOptionService
{
    public function getAllWorkTypeOptions()
    {
        return WorkTypeOption::all();
    }

    public function createWorkTypeOption($data)
    {
        return WorkTypeOption::create($data);
    }

    public function findWorkTypeOptionById($id)
    {
        return WorkTypeOption::find($id);
    }

    public function updateWorkTypeOption($data, $id)
    {
        $client = $this->findWorkTypeOptionById($id);
        if(!$client){
            return null;
        }
        else {
            $client->update($data);
            return $client;
        }
    }

    public function deleteWorkTypeOption($id)
    {
        $client = $this->findWorkTypeOptionById($id);
        if(!$client){
            return null;
        }
        else{
            return $client->delete();
        }
    }
}
