<?php

namespace App\Models\Project\Relationship;
use App\Models\Department\Department;
use App\Models\Project\Departmentable;
use App\Models\Project\ProjectDetails;
use App\Models\Project\ProjectWorkType;
use App\Models\Project\ProjectWorkTypeValue;
use App\Models\User;

trait ProjectRelationship
{
    // Define your relationships here
    public function financialDetails()
    {
        return $this->hasOne(ProjectDetails::class);
    }

    public function departments()
    {
        return $this->morphToMany(Department::class,'departmentable')->withPivot('id');
    }

    public function workTypeValues()
    {
        return $this->hasManyThrough(
            ProjectWorkTypeValue::class,
            Departmentable::class,
            'departmentable_id', // Foreign key on departmentable table...
            'project_department_id', // Foreign key on ProjectWorkTypeValue table...
            'id', // Local key on projects table...
            'id' // Local key on departmentable table...
        )->where('departmentables.departmentable_type', Project::class);
    }

    public function salespersons()
    {
        return $this->belongsToMany(User::class, 'project_salespersons');
    }

    public function workTypes()
    {
        return $this->morphMany(ProjectWorkType::class, 'workable');
    }


}
