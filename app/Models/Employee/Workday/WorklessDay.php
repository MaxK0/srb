<?php

namespace App\Models\Employee\Workday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorklessDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'start', 'end',
        'status_id',
        'workday_id'
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'status_id' => 'integer',
        'workday_id' => 'integer'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(WorklessStatus::class, 'status_id');
    }

    public function workday(): BelongsTo
    {
        return $this->belongsTo(Workday::class);
    }
}
