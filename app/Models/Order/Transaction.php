<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'type_id',
        'transaction_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'type_id' => 'integer'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class, 'type_id');
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
