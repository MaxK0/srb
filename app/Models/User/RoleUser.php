<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'role_id' => 'integer'
    ];
}
