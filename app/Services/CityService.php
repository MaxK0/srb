<?php

namespace App\Services;

use App\Models\City;

class CityService extends BaseService
{
    public function __construct()
    {
        parent::__construct(City::class);
    }
}
