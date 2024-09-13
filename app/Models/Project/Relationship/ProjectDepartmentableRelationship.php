<?php

namespace App\Models\Project\Relationship;
use App\Models\Project\ProjectWorkTypeValue;

trait ProjectDepartmentableRelationship
{
    // Define your relationships here
    public function departmentable()
    {
        return $this->morphTo();
    }

    public function projectWorkTypeValues()
    {
        return $this->hasMany(ProjectWorkTypeValues::class, 'project_department_id');
    }
}
