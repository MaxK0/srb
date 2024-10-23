<?php

namespace App\Services;

use App\Filters\EmployeeFilter;
use App\Filters\PositionFilter;
use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;

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
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->select([
                'employees.id',
                'users.email',
                'users.sex',
                'positions.title AS position',
                DB::raw('CONCAT(users.lastname, " ", LEFT(users.name, 1), ".", " ", LEFT(users.patronymic, 1), ".") AS fio_short')
            ])
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

        $branches = $branchService->ownerBranches(['id', 'title']);
        $positions = $positionService->ownerPositions(['id', 'title']);
        $sexes = $userService->getSexes();


        return [
            'branches' => $branches,
            'positions' => $positions,
            'sexes' => $sexes
        ];
    }


    public function dataForHire(PositionFilter $filter): array
    {
        $branchService = app(BranchService::class);

        $data['branches'] = $branchService->ownerBranches(['id', 'title']);

        if ($data['branch_id'] = request()->input('branch_id')) {
            $data['positions'] = Position::filter($filter)->select(['id', 'title'])->get();
        }

        return $data;
    }

    /**
     * TODO: Пока у пользователя может лишь быть одно рабочее место. Нужно сделать так, чтобы сотрудник мог уволиться, если захочет на новую работу.
     * Можно сделать, чтобы сотрудник мог работать в нескольких филиалов, но тогда нужно переделать бд.
     */
    public function hire(array $data): Employee
    {
        $employee = $this->model->create($data);

        $employee->branches()->sync($data['branch_id']);

        return $employee;
    }


    public function dataForEdit(): array
    {
        return [];
    }
}
