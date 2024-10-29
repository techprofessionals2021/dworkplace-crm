<?php

namespace App\Models\Project\Relationship;

trait ProjectThreadRelationship
{
    public function threadable()
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(ProjectThread::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasOne(ProjectThread::class, 'parent_id');
    }
}
