<?php

namespace App\Models\Owner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'information',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(Owner::class);
    }
}
