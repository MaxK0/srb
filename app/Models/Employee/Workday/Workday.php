<?php

namespace App\Models\Employee\Workday;

use App\Models\Employee\Employee;
use App\Models\Owner\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workday extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start',
        'days_work', 'days_rest',
        'employee_id',
        'branch_id',
        'time_start', 'time_end'
    ];

    protected $casts = [
        'date_start' => 'date',
        'days_work' => 'integer',
        'days_rest' => 'integer',
        'employee_id' => 'integer',
        'branch_id' => 'integer',
        'time_start' => 'datetime:H:i',
        'time_end' => 'datetime:H:i'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function extraDays(): HasMany
    {
        return $this->hasMany(ExtraDay::class);
    }

    public function worklessDays(): HasMany
    {
        return $this->hasMany(WorklessDay::class);
    }
}
