<?php

namespace App\Models\Employee;

use App\Models\Employee\Workday\Workday;
use App\Models\Order\Order;
use App\Models\Owner\Branch;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filterable\Interfaces\Filterable as FilterableInterface;
use Filterable\Traits\Filterable as FilterableTrait;

class Employee extends Model implements FilterableInterface
{
    use HasFactory, FilterableTrait;

    protected $fillable = [
        'work_phone',
        'user_id',
        'position_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'position_id' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'branch_employees');
    }

    public function workdays(): HasMany
    {
        return $this->hasMany(Workday::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'schedule');
    }
}
