<?php

namespace App\Services;

use App\Models\Employee\Workday\Workday;

class WorkdayService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Workday::class);
    }


    public function dataForCreate(): array
    {
        return [];
    }


    public function dataForShow(): array
    {
        return [];
    }


    public function dataForEdit(): array
    {
        return [];
    }
}
