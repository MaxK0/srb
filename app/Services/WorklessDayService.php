<?php

namespace App\Services;

use App\Models\Employee\Workday\WorklessDay;

class WorklessDayService extends BaseService
{
    public function __construct()
    {
        parent::__construct(WorklessDay::class);
    }
}
