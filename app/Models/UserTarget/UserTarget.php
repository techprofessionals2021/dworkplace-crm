<?php

namespace App\Models\UserTarget;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserTarget\Relationship\UserTargetRelationship;

class UserTarget extends Model
{
    use HasFactory, UserTargetRelationship;

    protected $fillable = ['user_id', 'department_id', 'value', 'start_date', 'end_date', 'type', 'status_id'];
}
