<?php

namespace App\Models\Project\Relationship;
 use App\Models\PaymentMethod\PaymentMethod;
trait ProjectTransactionRelationship
{

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
