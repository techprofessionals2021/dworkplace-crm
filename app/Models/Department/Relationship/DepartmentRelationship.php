<?php

namespace App\Models\Department\Relationship;

use App\Models\Department\Department;
use App\Models\User;

trait DepartmentRelationship
{
    /**
     * Get the manager for the department.
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get the parent department for the department.
     */
    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'parent_department_id');
    }

    /**
     * Get the status for the department.
     */
    // public function status()
    // {
    //     return $this->belongsTo(Status::class, 'status_id');
    // }
}
