<?php

namespace App\Models\ProjectUpdate\Relationship;

use App\Models\Project\ProjectThread;

trait ProjectUpdateRelationship
{
    public function projectable()
    {
        return $this->morphTo();
    }

    public function threads()
    {
        return $this->morphMany(ProjectThread::class, 'threadable');
    }
}
