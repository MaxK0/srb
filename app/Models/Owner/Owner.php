<?php

namespace App\Models\Owner;

use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\User\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    protected $casts = [
        'user_id' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function businesses(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'business_owners');
    }

    public function branches(): Builder
    {
        return Branch::whereHas('business.owners', function ($q) {
            return $q->where('owner_id', $this->id);
        });
    }

    public function positions(): Builder
    {
        return Position::whereHas('branch.business.owners', function ($q) {
            return $q->where('owner_id', $this->id);
        });
    }

    public function employees(): Builder
    {
        return Employee::whereHas('branch.business.owners', function ($q) {
            return $q->where('owner_id', $this->id);
        });
    }
}
