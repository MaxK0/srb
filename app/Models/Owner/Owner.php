<?php

namespace App\Models\Owner;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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

    public function branches(): Collection
    {
        return $this->businesses()
            ->with('branches')
            ->get()
            ->flatMap(fn($business) => $business->branches);
    }

    public function positions(): Collection
    {
        return $this->branches()
            ->flatMap(fn($branch) => $branch->positions);
    }
}
