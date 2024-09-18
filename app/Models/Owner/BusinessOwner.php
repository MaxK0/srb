<?php

namespace App\Models\Owner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'business_id'
    ];

    protected $casts = [
        'owner_id' => 'integer',
        'business_id' => 'integer'
    ];
}
