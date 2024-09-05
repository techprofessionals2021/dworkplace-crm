<?php

namespace App\Models\WorkType\Relationship;
use App\Models\Department\Department;

trait WorkTypeRelationship
{
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
