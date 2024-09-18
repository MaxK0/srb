<?php

namespace App\Services;

use App\Models\Owner\Owner;
use App\Models\User\User;

class OwnerService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Owner::class);
    }

    public function becomeOwner()
    {
        /**
         * @var User $user;
         */
        $user = auth()->user();

        $user->roles()
            ->sync(User::OWNER_ID);

        $owner = $this->create(['user_id' => $user->id]);

        return true;
    }
}
