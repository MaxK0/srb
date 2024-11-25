<?php

namespace App\Policies;

use App\Models\Employee\Workday\Workday;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class WorkdayPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Workday $workday): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Workday $workday): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Workday $workday): bool
    {
        //
    }
}
