<?php

namespace App\Services;

use App\Models\City;
use App\Models\Owner\Branch;
use App\Models\Owner\Business;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;

class BranchService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Branch::class);
    }

    public function dataForCreate(): array
    {
        $cities = City::all(['id', 'title']);

        $businesses = auth()
            ->user()
            ->owner()
            ->first()
            ->businesses()
            ->select('businesses.id', 'businesses.title')
            ->get();

        return [
            'cities' => $cities,
            'businesses' => $businesses
        ];
    }

    public function dataForEdit(Branch $branch): array
    {
        $data = $this->dataForCreate();

        $data['branch'] = $branch->load([
            'city' => function ($q) {
                $q->select('id', 'title');
            },
            'business' => function ($q) {
                $q->select('id', 'title');
            }
        ]);

        return $data;
    }

    public function dataForShow(Business $business): array
    {
        $branches = $business
            ->branches()
            ->select('id', 'title', 'address', 'information')
            ->paginate(15)
            ->withQueryString();

        return [
            'business' => $business,
            'branches' => $branches
        ];
    }
}
