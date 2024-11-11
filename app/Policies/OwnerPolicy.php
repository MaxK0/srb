<?php

namespace App\Policies;

use App\Models\Owner\Owner;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class OwnerPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return !$user->isOwner();
    }
}
