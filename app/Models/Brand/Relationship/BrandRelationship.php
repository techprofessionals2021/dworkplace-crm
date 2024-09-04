<?php

namespace App\Models\Brand\Relationship;

trait BrandRelationship
{
    public function sourceAccounts()
    {
        return $this->hasMany(SourceAccount::class);
    }
}
