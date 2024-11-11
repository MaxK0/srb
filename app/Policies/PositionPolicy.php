<?php

namespace App\Policies;

use App\Models\Employee\Position;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class PositionPolicy
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
    public function view(User $user, Position $position): bool
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
    public function update(User $user, Position $position): bool
    {
        if (! $user->isOwner()) return false;

        return $this->isUserOwnPosition($user, $position);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Position $position): bool
    {
        if (! $user->isOwner()) return false;

        return $this->isUserOwnPosition($user, $position);
    }


    public function isUserOwnPosition(User $user, Position $position): bool
    {
        $owner = $user->owner;

        return $owner
            ->businesses()
            ->whereHas('branches', function ($q) use ($position) {
                $q->where('branches.id', $position->branch_id);
            })
            ->exists();
    }
}
