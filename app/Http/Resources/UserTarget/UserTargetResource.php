<?php

namespace App\Http\Resources\UserTarget;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTargetResource extends JsonResource
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
            'user' => @$this->user->name,
            'department' => @$this->department->name,
            'value' => @$this->value,
            'start_date' => @$this->start_date,
            'end_date' => @$this->end_date,
            'type' => @$this->type,
            'status' => @$this->status->name
        ];
    }
}
