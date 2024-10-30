<?php

namespace App\Models\UserTarget\Relationship;

use App\Models\User;
use App\Models\Department\Department;
use App\Models\Status\Status;

trait UserTargetRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
