<?php

namespace App\Models\Client;

use App\Models\Client\Relationship\ClientRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, ClientRelationship, SoftDeletes;

    protected $fillable = [
        'source_account_id',
        'name',
        'username',
        'email',
        'contact_no'
    ];
}
