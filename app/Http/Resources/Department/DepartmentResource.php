<?php

namespace App\Http\Resources\Department;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => @$this->id,
            'name' => @$this->name,
            'manager' => @$this->manager->name,
            'parent_department' => @$this->parentDepartment->name,
            'description' => @$this->description,
            // 'status' => $this->status_id,
        ];
    }
}
