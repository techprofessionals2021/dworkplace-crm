<?php

namespace App\Models\Client\Relationship;
use App\Models\SourceAccount\SourceAccount;

trait ClientRelationship
{
    public function sourceAccount()
    {
        return $this->belongsTo(SourceAccount::class, 'source_account_id');
    }
}
