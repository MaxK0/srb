<?php

namespace App\Services;

use App\Filters\PositionFilter;
use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\User\User;

class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function getSexes(): array
    {
        $sexMale = User::SEX_MALE;
        $sexFemale = User::SEX_FEMALE;

        return [
            [
                'id' => $sexMale,
                'title' => User::getSexes()[$sexMale]
            ],
            [
                'id' => $sexFemale,
                'title' => User::getSexes()[$sexFemale]
            ]
        ];
    }


    public function find(array $data): ?User
    {
        if (!empty($data['email'])) {
            return $this->model
                ->where('email', $data['email'])
                ->first();
        }

        if (!empty($data['phone'])) {
            return $this->model
                ->where('phone', $data['phone'])
                ->first();
        }

        return null;
    }


    public function dataForHire(PositionFilter $filter): array
    {
        $branchService = app(BranchService::class);

        $data['branches'] = $branchService->ownerBranches(['id', 'title']);

        if ($data['filter']['branchId'] = request('branch_id')) {
            $data['positions'] = Position::filter($filter)->select(['id', 'title'])->get();
        }

        return $data;
    }

    
    public function hire(array $data, User $user): Employee
    {
        $data['user_id'] = $user->id;

        $employee = Employee::create($data);

        $employee->branches()->attach($data['branch_id']);

        if (! $user->isEmployee()) {
            $user->roles()->attach(User::EMPLOYEE_ID);
        }


        return $employee;
    }
}
