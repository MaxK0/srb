<?php

namespace App\Services;

use App\Filters\EmployeeFilter;
use App\Filters\PositionFilter;
use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\Owner\Owner;
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

    // TODO: Если удалить должность, то она всё равно выводится. Выяснить почему и может исправить.
    public function dataForIndex(EmployeeFilter $filter, ?int $perPage): array
    {
        $owner = auth()->user()->owner;

        $employees = $owner
            ->employees()
            ->where('employees.branch_id', request()->cookie('branch_id'))
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
            ->paginate($perPage)
            ->withQueryString();

        $data =  [
            'employees' => $employees,
            'filter' => [
                // 'branchId' => request('branch_id')
            ]
        ];

        return $data;
    }


    public function dataForCreate(PositionFilter $filter): array
    {
        $userService = app(UserService::class);

        $data['branches'] = Owner::staticBranches()->select(['id', 'title'])->get();
        $data['sexes'] = $userService->getSexes();

        if ($data['filter']['branchId'] = request('branch_id')) {
            $data['positions'] = Position::filter($filter)->select(['id', 'title'])->get();
        }

        return $data;
    }


    public function createWithUser(array $data): Employee
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $data['user_id'] = $user->id;

        $employee = $this->model->create($data);

        if (! $user->isEmployee()) {
            $user->roles()->attach(User::EMPLOYEE_ID);
        }

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
            'branch' => function ($q) {
                $q->select(['id', 'title']);
            },
            'workday' => function ($q) {
                $q->select(['id', 'date_start', 'days_work', 'days_rest', 'time_start', 'time_end', 'employee_id']);
            }
        ]);

        return [
            'employee' => $employee,
        ];
    }


    public function dataForEdit(Employee $employee, PositionFilter $filter): array
    {
        $data['branches'] = Owner::staticBranches()->select(['id', 'title'])->get();
        $data['employee'] = $employee->load(
            [
                'branch' => function ($q) {
                    $q->select(['branches.id', 'title']);
                },
                'position' => function ($q) {
                    $q->select(['positions.id', 'title']);
                }
            ]
        );

        if ($data['filter']['branchId'] = request('branch_id')) {
            $data['positions'] = Position::filter($filter)->select(['id', 'title'])->get();
        } else {
            $data['positions'] = Position::where('branch_id', $employee->branch_id)->select(['id', 'title'])->get();
        }

        return $data;
    }
}
