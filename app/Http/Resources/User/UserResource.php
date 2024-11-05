<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'status' => "status_active",
            'roles'=> $this->roles()->pluck('name')->toArray(),
            'departments'=> $this->departments()->pluck('name')->toArray(),
            'profile_image' => $this->getFirstMediaUrl('profile_images')
            // 'status' => new StatusResource($this->whenLoaded('status')), // if you want to include the status details
        ];
    }
}
