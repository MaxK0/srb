<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    public const CLIENT_ID = 0;
    public const EMPLOYEE_ID = 1;
    public const OWNER_ID = 2;

    public const CLIENT = 'Клиент';
    public const EMPLOYEE = 'Сотрудник';
    public const OWNER = 'Владелец';

    protected $fillable = [
        'id', 'title'
    ];

    protected $casts = [
        'id' => 'integer'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
