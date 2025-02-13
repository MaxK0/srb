<?php

namespace App\Policies;

use App\Models\Employee\Employee;
use App\Models\Employee\Workday\Workday;
use App\Models\User\User;
use App\Services\OwnerService;

class WorkdayPolicy
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
        $workday = $employee->workday;

        return OwnerService::isOwnInBusinesses($user, $workday, 'branches.employees.workday') ||
            $this->isEmployeeOwnWorkday($user, $workday);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Employee $employee): bool
    {
        return !$employee->workday()->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Employee $employee): bool
    {
        $workday = $employee->workday;

        return OwnerService::isOwnInBusinesses($user, $workday, 'branches.employees.workday');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Employee $employee): bool
    {
        $workday = $employee->workday;

        return OwnerService::isOwnInBusinesses($user, $workday, 'branches.employees.workday');
    }

    protected function isEmployeeOwnWorkday(User $user, Employee $employee)
    {
        if (!$user->isEmployee()) return false;

        $workday = $employee->workday;

        $isEmployeeWorkday = $user
            ->employees()
            ->whereHas('workday', function ($q) use ($workday) {
                $q->where('workdays.id', $workday->id);
            })->exists();

        return $isEmployeeWorkday;
    }
}
