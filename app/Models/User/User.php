<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Client;
use App\Models\Employee\Employee;
use App\Models\Owner\Owner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public const SEX_MALE = 'м';
    public const SEX_FEMALE = 'ж';



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
        'sex',
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

    protected $appends = ['is_owner', 'fio_short', 'sex_full', 'formatted_phone'];

    public static function getSexes(): array
    {
        return [
            self::SEX_MALE => 'Мужской',
            self::SEX_FEMALE => 'Женский'
        ];
    }

    public function getSexFullAttribute(): ?string
    {
        return self::getSexes()[$this->sex] ?? null;
    }

    public function getFioShortAttribute(): string
    {
        $name = mb_substr($this->name, 0, 1) . '.';
        $fio = $this->lastname . ' ' . $name;
        if ($this->patronymic) $fio .= mb_substr($this->patronymic, 0, 1) . '.';
        return $fio;
    }

    public function getFormattedPhoneAttribute()
    {
        $phone = $this->phone;

        $phone = preg_replace("/[^0-9]/", "", $phone);

        $formattedPhone = "+" . substr($phone, 0, 1) . " (" . substr($phone, 1, 3) . ") " . substr($phone, 4, 3) . " " . substr($phone, 7, 2) . "-" . substr($phone, 9, 2);

        return $formattedPhone;
    }

    public function getIsOwnerAttribute(): bool
    {
        return $this->isOwner();
    }

    public function isOwner(): bool
    {
        return $this->roles()->where('title', self::OWNER)->exists();
    }

    public function isEmployee(): bool
    {
        return $this->roles()->where('title', self::EMPLOYEE)->exists();
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class);
    }
}
