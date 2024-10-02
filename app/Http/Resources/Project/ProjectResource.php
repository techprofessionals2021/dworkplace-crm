<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'sales_code'=>@$this->sales_code,
            'title'=>@$this->title,
            'source_account' =>@$this->sourceAccounts->name,
            'client'=>@$this->clients->name,
            'deadline'=>@$this->deadline,
            'department'=>@$this->departments->pluck('name'),
            'status' => $this->status ? [
                'name' => format_status_name($this->status->name),
                'class' => $this->status->class
            ] : null,
        ];
    }


}




