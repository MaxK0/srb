<?php

namespace App\Models\Employee;

use App\Models\Owner\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'branch_id'
    ];

    protected $casts = [
        'branch_id' => 'integer'
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
