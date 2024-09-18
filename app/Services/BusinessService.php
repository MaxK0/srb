<?php

namespace App\Services;

use App\Models\Owner\Business;
use App\Models\User\User;
use Illuminate\Pagination\LengthAwarePaginator;

class BusinessService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Business::class);
    }

    public function getUserBusinesses(?int $perPage = 25): LengthAwarePaginator
    {
        $businesses = auth()
            ->user()
            ->owner()
            ->first()
            ->businesses()
            ->select('id', 'title', 'information')
            ->paginate($perPage ?? 25);

        return $businesses;
    }
}
