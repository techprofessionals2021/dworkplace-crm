<?php

namespace App\Http\Resources\Status;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => @$this->id,
            'name' => @$this->name,
            'class' => @$this->class,
            'type' => @$this->type,
        ];
    }
}
