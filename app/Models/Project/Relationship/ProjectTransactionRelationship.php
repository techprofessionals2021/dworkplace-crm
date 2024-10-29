<?php

namespace App\Models\Project\Relationship;
 use App\Models\PaymentMethod\PaymentMethod;
 use App\Models\Currency\Currency;
 use App\Models\User;
trait ProjectTransactionRelationship
{

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    public  function currency(){
        return $this->belongsTo(Currency::class);
    }
    public  function user(){
        return $this->belongsTo(User::class);
    }
}
