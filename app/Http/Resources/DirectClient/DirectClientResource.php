<?php

namespace App\Http\Resources\DirectClient;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectClientResource extends JsonResource
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
            'email' => @$this->email,
            'contact' => @$this->contact
        ];
    }
}
