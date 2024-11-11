<?php

namespace App\Policies;

use App\Models\Owner\Business;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Bus;

class BusinessPolicy
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
    public function view(User $user, Business $business): bool
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
    public function update(User $user, Business $business): bool
    {
        if (! $user->isOwner()) return false;

        return $this->isUserOwnBusiness($user, $business);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Business $business): bool
    {
        if (! $user->isOwner()) return false;

        return $this->isUserOwnBusiness($user, $business);
    }


    public function isUserOwnBusiness(User $user, Business $business): bool
    {
        $owner = $user->owner;

        return $owner
            ->businesses()
            ->where('businesses.id', $business->id)
            ->exists();
    }
}
