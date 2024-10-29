<?php

namespace App\Http\Resources\WorkType;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'department' => [
                'id' => $this->department->id,
                'name' => $this->department->name,
            ],
            // Conditionally include the 'options' key only when type is 'dropdown'
            $this->mergeWhen($this->type === 'dropdown', [
                'options' => $this->options->map(function ($option) {
                    return [
                        'id' => $option->id,
                        'value' => $option->option_value,
                    ];
                }),
            ]),
        ];
    }
}
