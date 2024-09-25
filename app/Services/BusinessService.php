<?php

namespace App\Services;

use App\Models\City;
use App\Models\Owner\Business;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Collection;
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

    public function dataForCreate(): array
    {
        $cities = City::all(['id', 'title']);

        return [
            'cities' => $cities
        ];
    }
}
