<?php

namespace App\Services;

use App\Filters\EmployeeFilter;
use App\Filters\PositionFilter;
use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $branches->prepend(['id' => null, 'title' => 'Все филиалы']);

        $employees = $this->model
            ->filter($filter)
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select([
                'employees.id',
                'users.email',
                'users.sex',
                'positions.title AS position',
                DB::raw('CONCAT(users.lastname, " ", LEFT(users.name, 1), ".", IF(users.patronymic IS NOT NULL AND users.patronymic != "", CONCAT(" ", LEFT(users.patronymic, 1), "."), "")) AS fio_short')
            ])
            ->paginate(25)
            ->withQueryString();


        $data =  [
            'branches' => $branches,
            'employees' => $employees,
            'filter' => [
                'branchId' => request('branch_id')
            ]
        ];

        $data['branchId'] = request('branch_id');

        return $data;
    }


    public function dataForCreate(PositionFilter $filter): array
    {
        $branchService = app(BranchService::class);
        $userService = app(UserService::class);

        $data['branches'] = $branchService->ownerBranches(['id', 'title']);
        $data['sexes'] = $userService->getSexes();

        if ($data['branch_id'] = request()->input('branch_id')) {
            $data['positions'] = Position::filter($filter)->select(['id', 'title'])->get();
        }

        return $data;
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


    public function createWithUser(array $data): Employee
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $data['user_id'] = $user->id;

        $employee = $this->model->create($data);

        $employee->branches()->sync($data['branch_id']);

        return $employee;
    }


    public function dataForShow(Employee $employee): array
    {
        $employee->load([
            'user' => function ($q) {
                $q->select(['id', 'name', 'lastname', 'patronymic', 'phone', 'email', 'sex']);
            },
            'position' => function ($q) {
                $q->select(['id', 'title']);
            },
            'branches' => function ($q) {
                $q->select(['branches.id', 'title']);
            }
        ]);

        return [
            'employee' => $employee,
        ];
    }


    public function dataForEdit(Employee $employee, PositionFilter $filter): array
    {
        $branchService = app(BranchService::class);

        $data['branches'] = $branchService->ownerBranches(['id', 'title']);
        $data['employee'] = $employee->load(
            [
                'branches' => function ($q) {
                    $q->select(['branches.id', 'title']);
                },
                'position' => function ($q) {
                    $q->select(['id', 'title']);
                }
            ]
        );

        if ($data['branch_id'] = request()->input('branch_id')) {
            $data['positions'] = Position::filter($filter)->select(['id', 'title'])->get();
        } else {
            $data['positions'] = Position::where('branch_id', $employee->branches[0]->id)->select(['id', 'title'])->get();
        }

        return $data;
    }


    public function update(Model $employee, array|Collection $data): bool
    {
        $result = $employee->update($data);

        if ($result) $employee->branches()->sync($data['branch_id']);

        return $result;
    }
}
