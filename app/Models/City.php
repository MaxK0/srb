<?php

namespace App\Models;

use App\Models\Owner\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title'
    ];

    protected $casts = [
        'id' => 'integer'
    ];

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
