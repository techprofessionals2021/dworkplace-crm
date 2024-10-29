<?php

namespace App\Models\WorkTypeOption;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkTypeOption\Relationship\WorkTypeOptionRelationship;

class WorkTypeOption extends Model
{
    use HasFactory, WorkTypeOptionRelationship;

    protected $fillable = [
        'work_type_id',
        'option_value'
    ];
}
