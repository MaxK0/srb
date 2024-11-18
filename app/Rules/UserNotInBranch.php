<?php

namespace App\Rules;

use App\Models\Employee\BranchEmployee;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User\User;

class UserNotInBranch implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        $user = User::find($this->userId);
        if ($user && $user->employees) {
            foreach ($user->employees as $employee) {
                if ($employee->branches->contains('id', $value)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function message()
    {
        return 'Пользователь уже принадлежит к этой работе.';
    }
}
