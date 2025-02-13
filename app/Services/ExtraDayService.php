<?php

namespace App\Services;

use App\Models\Employee\Workday\ExtraDay;

class ExtraDayService extends BaseService
{
    public function __construct()
    {
        parent::__construct(ExtraDay::class);
    }
}
