<?php

namespace App\Models\Employee\Workday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtraDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'start', 'end',
        'timework_id',
        'workday_id'
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'timework_id' => 'integer',
        'workday_id' => 'integer',
    ];

    public function timework(): BelongsTo
    {
        return $this->belongsTo(Timework::class);
    }

    public function workday(): BelongsTo
    {
        return $this->belongsTo(Workday::class);
    }
}
