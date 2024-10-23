<?php

namespace App\Services;

use App\Models\User\User;

class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function getSexes(): array
    {
        $sexMale = User::SEX_MALE;
        $sexFemale = User::SEX_FEMALE;

        return [
            [
                'id' => $sexMale,
                'title' => User::getSexes()[$sexMale]
            ],
            [
                'id' => $sexFemale,
                'title' => User::getSexes()[$sexFemale]
            ]
        ];
    }


    public function find(array $data): ?User
    {
        if (!empty($data['email'])) {
            return $this->model
                ->where('email', $data['email'])
                ->first();
        }

        if (!empty($data['phone'])) {
            return $this->model
                ->where('phone', $data['phone'])
                ->first();
        }

        return null;
    }
}