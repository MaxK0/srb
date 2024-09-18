<?php

namespace App\Models;

use App\Models\Order\Order;
use App\Models\Owner\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'price',
        'duration', 'active',
        'information',
        'branch_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'datetime:H:i',
        'active' => 'boolean',
        'branch_id' => 'integer'
    ];

    public function getPriceFloorAttribute(): float
    {
        return floor($this->price);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
