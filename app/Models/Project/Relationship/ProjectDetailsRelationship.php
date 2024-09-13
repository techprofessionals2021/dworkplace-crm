<?php

namespace App\Models\Project\Relationship;

trait ProjectDetailsRelationship
{
    // Define your relationships here
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
