<?php

namespace App\Models\Owner;

use App\Models\City;
use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'business_id',
        'city_id',
        'information',
        'active'
    ];

    protected $casts = [
        'business_id' => 'integer',
        'city_id' => 'integer',
        'active' => 'boolean'
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
