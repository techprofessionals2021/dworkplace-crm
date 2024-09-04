<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'source_account' => @$this->sourceAccount->name,
            'name' => @$this->name,
            'username' => @$this->username,
            'email' => @$this->email,
            'contact_no' => @$this->contact_no
        ];
    }
}
