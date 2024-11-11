<?php

namespace App\Policies;

use App\Models\Employee\Employee;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Employee $employee): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Employee $employee): bool
    {
        return $user->isOwner() && $this->isUserOwnEmployee($user, $employee);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Employee $employee): bool
    {
        return $user->isOwner() && $this->isUserOwnEmployee($user, $employee);
    }


    public function hire(User $user, User $userForHire): bool
    {
        return $user->isOwner() && !$userForHire->isEmployee();
    }


    private function isUserOwnEmployee(User $user, Employee $employee): bool
    {
        $owner = $user->owner;

        return $owner
            ->businesses()
            ->whereHas('branches.employees', function ($q) use ($employee) {
                $q->where('employees.id', $employee->id);
            })
            ->exists();
    }
}
