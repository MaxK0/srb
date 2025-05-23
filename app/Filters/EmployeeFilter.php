<?php

namespace App\Filters;

use App\Models\Employee\Employee;
use Filterable\Filter;
use Illuminate\Database\Eloquent\Builder;

class EmployeeFilter extends Filter
{
    /**
     * Registered filters to operate upon.
     *
     * @var array<string>
     */
    protected array $filters = ['branch_id'];

    /**
     * Filter the query by a given attribute value.
     *
     * @param string $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function branchId(string $value): Builder
    {
        return $this->builder->where(app(Employee::class)->getTable() . '.branch_id', $value);
    }
}
