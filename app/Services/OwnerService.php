<?php

namespace App\Services;

use App\Models\Owner\Owner;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

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

    public static function isOwnInBusinesses(User $user, Model $model, string $relation)
    {
        if (!$user->isOwner()) return false;

        /** @var Owner $owner */
        $owner = $user->owner;

        return $owner->businesses()
            ->whereHas($relation, function ($q) use ($model) {
                $q->where('id', $model->id);
            })->exists();
    }
}
