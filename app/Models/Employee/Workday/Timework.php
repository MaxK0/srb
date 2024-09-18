<?php

namespace App\Models\Employee\Workday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timework extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end'
    ];

    protected $casts = [
        'start' => 'datetime:H:i',
        'end' => 'datetime:H:i'
    ];
}
