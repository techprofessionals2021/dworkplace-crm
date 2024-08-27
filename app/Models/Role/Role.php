<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role\Relationship\RoleRelationship;

class Role extends Model
{
    use HasFactory,RoleRelationship;

    protected $fillable = [
        'name'
    ];


}
