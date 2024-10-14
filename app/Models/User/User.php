<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Client;
use App\Models\Employee\Employee;
use App\Models\Owner\Owner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
// use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    // use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public const CLIENT = 'Клиент';
    public const OWNER = 'Владелец';
    public const EMPLOYEE = 'Сотрудник';

    public const CLIENT_ID = 0;
    public const OWNER_ID = 1;
    public const EMPLOYEE_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'patronymic',
        'phone',
        'email',
        'password',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    // protected $appends = [
    //     'profile_photo_url',
    // ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
        ];
    }

    protected $appends = ['is_owner', 'fio_short'];

    public function getFioShortAttribute(): string
    {
        $name = mb_substr($this->name, 0, 1) . '.';
        $fio = $this->lastname . ' ' . $name;
        if ($this->patronymic) $fio .= mb_substr($this->patronymic, 0, 1) . '.';
        return $fio;
    }

    public function getIsOwnerAttribute(): bool
    {
        return $this->isOwner();
    }

    public function isOwner(): bool
    {
        return $this->roles()->where('title', self::OWNER)->exists();
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class);
    }
}
