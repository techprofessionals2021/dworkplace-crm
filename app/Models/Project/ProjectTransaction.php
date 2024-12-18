<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Relationship\ProjectTransactionRelationship;

class ProjectTransaction extends Model
{
    use HasFactory,ProjectTransactionRelationship;

    protected $fillable = [
        'projectable_id',
        'projectable_type',
        'user_id',
        'payment_method_id',
        'currency_id',
        'date',
        'amount',
    ];
    public function projectable(): MorphTo
    {
        return $this->morphTo();
    }

}
