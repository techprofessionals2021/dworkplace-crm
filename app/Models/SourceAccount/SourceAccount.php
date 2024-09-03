<?php

namespace App\Models\SourceAccount;
use App\Models\SourceAccount\Relationship\SourceAccountRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceAccount extends Model
{
    
    use HasFactory ,SourceAccountRelationship;
    protected $fillable = [
        'name'  ,
        'brand_id',
        'username',
        'email'
    ];

}
