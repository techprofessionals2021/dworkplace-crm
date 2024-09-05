<?php

namespace App\Models\DirectClient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DirectClient\Relationship\DirectClientRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectClient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'contact'
    ];
}
