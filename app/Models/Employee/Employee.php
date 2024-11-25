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
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model implements FilterableInterface
{
    use HasFactory, FilterableTrait;

    protected $fillable = [
        'work_phone',
        'user_id',
        'position_id',
        'branch_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'position_id' => 'integer',
        'branch_id' => 'integer'
    ];

    protected $appends = ['formatted_work_phone'];


    public function getFormattedWorkPhoneAttribute()
    {
        $phone = $this->work_phone;

        $phone = preg_replace("/[^0-9]/", "", $phone);

        $formattedPhone = "+" . substr($phone, 0, 1) . " (" . substr($phone, 1, 3) . ") " . substr($phone, 4, 3) . " " . substr($phone, 7, 2) . "-" . substr($phone, 9, 2);

        return $formattedPhone;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function workday(): HasOne
    {
        return $this->hasOne(Workday::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'schedule');
    }
}
