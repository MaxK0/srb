<?php

namespace App\Policies;

use App\Models\Employee\Workday\WorklessDay;
use App\Models\User\User;
use App\Services\WorklessDayService;
use Illuminate\Auth\Access\Response;

class WorklessDayPolicy
{
    public function __construct(protected WorklessDayService $worklessDayService) {}

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WorklessDay $worklessDay): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WorklessDay $worklessDay): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WorklessDay $worklessDay): bool
    {
        return true;
    }
}
