<?php

namespace App\Models\Employee\Workday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorklessStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function worklessDays(): HasMany
    {
        return $this->hasMany(WorklessDay::class, 'status_id');
    }
}
