<?php

namespace App\Models\SourceAccount\Relationship;
use App\Models\SourceAccount\SourceAccount;
use App\Models\Brand\Brand;
use App\Models\Project\Project;

trait SourceAccountRelationship
{

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }


}
