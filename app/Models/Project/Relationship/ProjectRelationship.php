<?php

namespace App\Models\Project\Relationship;
use App\Models\Department\Department;
use App\Models\Project\ProjectDetails;
use App\Models\Project\ProjectWorkTypeValue;

trait ProjectRelationship
{
    // Define your relationships here
    public function financialDetails()
    {
        return $this->hasOne(ProjectDetails::class);
    }

    public function departments()
    {
        return $this->morphToMany(Department::class,'departmentable');
    }
}
