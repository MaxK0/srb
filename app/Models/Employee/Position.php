<?php

namespace App\Models\Employee;

use App\Models\Owner\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filterable\Interfaces\Filterable as FilterableInterface;
use Filterable\Traits\Filterable as FilterableTrait;

class Position extends Model implements FilterableInterface
{
    use HasFactory, FilterableTrait;

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
