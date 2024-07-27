<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';

    protected $fillable = [
        'employee_id',
        'order_id'
    ];

    protected $casts = [
        'emloyee_id' => 'integer',
        'order_id' => 'integer'
    ];
}
