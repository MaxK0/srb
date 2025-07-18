<?php

namespace App\Services;

use App\Models\City;
use App\Models\Owner\Branch;
use App\Models\Owner\Business;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BusinessService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Business::class);
    }

    public function getUserBusinesses(?int $perPage): LengthAwarePaginator
    {
        $businesses = auth()
            ->user()
            ->owner()
            ->first()
            ->businesses()
            ->select('businesses.id', 'title', 'information')
            ->paginate($perPage ?? 25)
            ->withQueryString();

        return $businesses;
    }

    public function dataForCreate(): array
    {
        $cities = City::all(['id', 'title']);

        return compact('cities');
    }

    public function dataForShow(Business $business, ?int $perPage): array
    {
        $branches = $business
            ->branches()
            ->select('id', 'title', 'address', 'information')
            ->paginate($perPage)
            ->withQueryString();

        return compact('business', 'branches');
    }

    public function create(array|Collection $data): Business
    {
        if (is_array($data)) {
            $data = collect($data);
        }

        $dataBusiness = $data->only(['title', 'information', 'address']);

        $business = Business::create($dataBusiness->all());

        $business->branches()->create($dataBusiness->all());

        $business->owners()
            ->sync(
                auth()
                    ->user()
                    ->owner
                    ->id
            );

        return $business;
    }

    public function update(Model $business, array|Collection $data): bool
    {
        if ($business->active == $data['active'])
            return $business->update($data);

        $branches = $business->branches()->get();

        $branches->each(function (Branch $branch) use ($data) {
            $branch->update([
                'active' => $data['active']
            ]);
        });

        return $business->update($data);
    }
}
