<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchEmployee extends Model
{
    use HasFactory;

    protected $table = 'branch_employees';

    protected $fillable = [
        'branch_id',
        'employee_id'
    ];

    protected $casts = [
        'branch_id' => 'integer',
        'employee_id' => 'integer'
    ];
}
