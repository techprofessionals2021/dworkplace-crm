<?php

namespace App\Http\Resources\SourceAccount;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SourceAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[    
            'id' => @$this->id,
            'name' => @$this->name,
            'email'=> @$this->email,
            'username'=>@$this->username,
            'brand' => @$this->brand->name,
            
        ];
     }
}
