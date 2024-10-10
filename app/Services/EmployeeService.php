<?php

namespace App\Services;

use App\Models\Employee\Employee;

class EmployeeService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Employee::class);
    }


    public function dataForCreate(): array
    {
        return [];
    }


    public function dataForEdit(): array
    {
        return [];
    }
}
