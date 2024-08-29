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
            'id'=> @$this->id,
            'manager' => @$this->manager->name,
            'parent_department' => @$this->parentDepartment->name,
            'name' => @$this->name,
            'description' => @$this->description,
            'status' => $this->status_id,
            'is_projectable'=>$this->is_projectable,
            'type'=>$this->type
        ];
    }
}
