<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name'
    ];

}
