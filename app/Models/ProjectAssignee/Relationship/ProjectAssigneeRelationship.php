<?php

namespace App\Models\ProjectAssignee\Relationship;

use App\Models\User;

trait ProjectAssigneeRelationship
{
    public function projectable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, "assigned_by");
    }
}
