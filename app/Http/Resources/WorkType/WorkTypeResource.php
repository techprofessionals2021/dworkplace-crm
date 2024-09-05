<?php

namespace App\Http\Resources\WorkType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class WorkTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => @$this->id,
            'name' => @$this->name,
            'type'=> @$this->type,
            'department'=>@$this->department->name
        ];
    }
}
