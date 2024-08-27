<?php

namespace App\Services\Status;

use App\Http\Resources\Status\StatusResource;
use App\Models\Status\Status;

class StatusService
{
    /**
     * Get all statuses.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStatuses()
    {
        $statuses = Status::all();
        return StatusResource::collection($statuses);
    }
}