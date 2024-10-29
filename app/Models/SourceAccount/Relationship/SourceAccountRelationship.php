<?php

namespace App\Models\SourceAccount\Relationship;
use App\Models\SourceAccount\SourceAccount;
use App\Models\Brand\Brand;

trait SourceAccountRelationship
{

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


}
