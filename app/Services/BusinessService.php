<?php

namespace App\Services;

use App\Models\City;
use App\Models\Owner\Branch;
use App\Models\Owner\Business;
use App\Models\User\User;
use Illuminate\Support\Collection;
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
            ->select('businesses.id', 'title', 'information')
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

    public function create(array|Collection $data): Business
    {
        if (is_array($data)) {
            $data = collect($data);
        }

        $dataBusiness = $data->only(['title', 'information']);

        $business = Business::create($dataBusiness->all());
        $businessId = $business->id;

        $dataBranch = $data->merge([
            'business_id' => $businessId
        ]);

        Branch::create($dataBranch->all());

        $business->owners()
            ->sync(
                auth()
                    ->user()
                    ->owner()
                    ->id()
            );

        return $business;
    }
}
