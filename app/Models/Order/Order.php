<?php

namespace App\Models\Order;

use App\Models\Client;
use App\Models\Employee\Employee;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'start', 'end',
        'client_id',
        'service_id',
        'status_id',
        'transaction_id',
        'information'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'client_id' => 'integer',
        'service_id' => 'integer',
        'status_id' => 'integer',
        'transaction_id' => 'integer'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'schedule');
    }
}
