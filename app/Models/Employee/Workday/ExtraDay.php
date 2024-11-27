<?php

namespace App\Models\Employee\Workday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtraDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start', 'date_end',
        'time_start', 'time_end',
        'workday_id'
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
        'workday_id' => 'integer',
        'time_start' => 'datetime:H:i',
        'time_end' => 'datetime:H:i'
    ];

    public function workday(): BelongsTo
    {
        return $this->belongsTo(Workday::class);
    }
}
