<?php

namespace App\Services\WorkType;
use App\Models\WorkType\WorkType;

class WorkTypeService
{
    /**
     * Get all service.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllWorkTypes()
    {
        return WorkType::all();
    }

    public function createWorkType(array $data)
    {
        return WorkType::create($data);
    }

    public function updateWorkType(array $data, int $id)
    {
        $workType = WorkType::findOrFail($id);
        $workType->update($data);
        return $workType;
    }
        
    public function deleteWorkType(string $id)
    {
        $workType = $this->getWorkTypeById($id);

        if (!$workType) {
            return false;
        }

        return $workType->delete();
    }
}
