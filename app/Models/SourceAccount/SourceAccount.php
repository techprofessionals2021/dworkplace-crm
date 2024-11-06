<?php

namespace App\Models\SourceAccount;
use App\Models\SourceAccount\Relationship\SourceAccountRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SourceAccount extends Model
{
    
    use HasFactory ,SourceAccountRelationship,SoftDeletes;
    protected $fillable = [
        'name'  ,
        'brand_id',
        'username',
        'email'
    ];

    protected $dates = ['deleted_at'];

}
