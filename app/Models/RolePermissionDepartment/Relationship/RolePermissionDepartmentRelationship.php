<?php

namespace App\Models\RolePermissionDepartment\Relationship;

use App\Models\Permission\Permission;
use App\Models\Role\Role;
use App\Models\Department\Department;
use App\Models\User;

trait RolePermissionDepartmentRelationship
{

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


}
