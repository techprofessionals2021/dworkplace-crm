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
            'manager' => @$this->manager->name,
            'parent_department' => @$this->parentDepartment->name,
            'name' => @$this->name,
            'description' => @$this->description,
            // 'status' => $this->status_id,
        ];
    }
}
