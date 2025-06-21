<?php

namespace App\Policies;

use App\Models\Owner\Branch;
use App\Models\User\User;
use App\Services\OwnerService;
use Illuminate\Auth\Access\Response;

class BranchPolicy
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
    public function view(User $user, Branch $branch): bool
    {
        return OwnerService::isOwnInBusinesses($user, $branch, 'branches');
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
    public function update(User $user, Branch $branch): bool
    {
        return OwnerService::isOwnInBusinesses($user, $branch, 'branches');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Branch $branch): bool
    {
        return OwnerService::isOwnInBusinesses($user, $branch, 'branches');
    }
}
