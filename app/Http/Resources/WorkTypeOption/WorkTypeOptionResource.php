<?php

namespace App\Http\Resources\WorkTypeOption;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkTypeOptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'work_type' => @$this->workType->name,
            'option_value' => @$this->option_value,
        ];
    }
}
