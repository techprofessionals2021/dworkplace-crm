<?php

namespace App\Models\WorkType\Relationship;
use App\Models\Department\Department;
use App\Models\WorkTypeOption\WorkTypeOption;

trait WorkTypeRelationship
{
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function options()
    {
        return $this->hasMany(WorkTypeOption::class);
    }
}
