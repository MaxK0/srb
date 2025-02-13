<?php

namespace App\Policies;

use App\Models\Employee\Workday\ExtraDay;
use App\Models\User\User;
use App\Services\ExtraDayService;
use Illuminate\Auth\Access\Response;

class ExtraDayPolicy
{
    public function __construct(protected ExtraDayService $extraDayService) {}

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
    public function view(User $user, ExtraDay $extraDay): bool
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
    public function update(User $user, ExtraDay $extraDay): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExtraDay $extraDay): bool
    {
        return true;
    }
}
