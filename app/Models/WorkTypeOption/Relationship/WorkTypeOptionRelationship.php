<?php

namespace App\Models\WorkTypeOption\Relationship;

use App\Models\WorkType\WorkType;

trait WorkTypeOptionRelationship
{
    public function workType(){
        return $this->belongsTo(WorkType::class, 'work_type_id');
    }
}
