<?php

namespace App\Http\Resources\WorkType;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkTypeCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($workTypes, $department) {
            return [
                'department_id' => $workTypes->first()->department->id,
                'department' => $department,
                'work_types' => WorkTypeResource::collection($workTypes),
            ];
        })->values()->all();
    }
}
