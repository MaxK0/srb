<?php

namespace App\Services;

use App\Filters\EmployeeFilter;
use App\Models\Employee\Employee;
use App\Models\User\User;

class EmployeeService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Employee::class);
    }

    public function dataForIndex(EmployeeFilter $filter): array
    {
        $branchService = app(BranchService::class);

        $branches = $branchService->ownerBranches(['id', 'title']);

        $employees = $this->model
            ->filter($filter)
            ->with(['user', 'position'])
            ->select(['employees.id', 'users.name', 'users.lastname', 'users.phone', 'users.email', 'positions.title'])
            ->paginate(25)
            ->withQueryString();

        $data =  [
            'branches' => $branches,
            'employees' => $employees
        ];

        if ($branchId = request('branch_id')) $data['branchId'] = $branchId;

        return $data;
    }


    public function dataForCreate(): array
    {
        $branchService = app(BranchService::class);
        $positionService = app(PositionService::class);
        $userService = app(UserService::class);

        $branches = $branchService->ownerBranches();      
        $positions = $positionService->ownerPositions(); 
        $sexes = $userService->getSexes();  
             

        return [
            'branches' => $branches,
            'positions' => $positions,
            'sexes' => $sexes
        ];
    }


    public function dataForEdit(): array
    {
        return [];
    }
}
