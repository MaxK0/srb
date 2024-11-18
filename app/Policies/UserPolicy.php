<?php

namespace App\Policies;

use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function hire(User $user, User $userForHire): bool
    {
        return $user->isOwner();
    }


    public function find(User $user): bool
    {
        return $user->isOwner();
    }

    // 
    // public function attachToClients(User $user, User $userForClients): bool
    // {
        
    // }
}
