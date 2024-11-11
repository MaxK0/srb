<?php

namespace App\Policies;

use App\Models\Owner\Branch;
use App\Models\User\User;
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
    public function update(User $user, Branch $branch): bool
    {
        return $user->isOwner() && $this->isUserOwnBranch($user, $branch);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Branch $branch): bool
    {
        return $user->isOwner() && $this->isUserOwnBranch($user, $branch);
    }


    private function isUserOwnBranch(User $user, Branch $branch): bool
    {
        $owner = $user->owner;

        return $owner
            ->businesses()
            ->whereHas('branches', function ($q) use ($branch) {
                $q->where('branches.id', $branch->id);
            })
            ->exists();
    }
}
