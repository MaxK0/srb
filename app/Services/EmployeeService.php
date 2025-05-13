<?php

namespace App\Services;

use App\Filters\EmployeeFilter;
use App\Filters\PositionFilter;
use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\Owner\Owner;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class EmployeeService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Employee::class);
    }

    public function dataForIndex(EmployeeFilter $eFilter, ?int $perPage): array
    {
        $owner = auth()->user()
            ->owner;

        $employees = $owner
            ->employees()
            ->where('employees.branch_id', request()->cookie('branch_id'))
            ->filter($eFilter)
            ->select(['id', 'user_id', 'position_id', 'branch_id'])
            ->with([
                'user' => function ($q) {
                    $q->select(['id', 'email', 'sex', 'lastname', 'name', 'patronymic']);
                },
                'position' => function ($q) {
                    $q->select(['id', 'title']);
                }
            ])
            ->paginate($perPage)
            ->withQueryString();


        $filter = [
            'branchId' => request('branch_id')
        ];

        return compact('employees', 'filter');
    }


    public function dataForCreate(PositionFilter $pFilter): array
    {
        $userService = app(UserService::class);

        $branches = Owner::staticBranches()->select(['id', 'title'])->get();
        $sexes = $userService->getSexes();
        $positions = null;

        if ($filter['branchId'] = request('branch_id')) {
            $positions = Position::filter($pFilter)->select(['id', 'title'])->get();
        }

        return compact('branches', 'sexes', 'filter', 'positions');
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
                $q->with([
                    'extraDays',
                    'worklessDays' => fn($q2) => $q2->with('status')
                ])
                    ->select(['id', 'date_start', 'days_work', 'days_rest', 'time_start', 'time_end', 'employee_id']);
            }
        ]);

        $can = [
            'manage' => auth()->user()->can('update', $employee)
        ];

        return compact('employee', 'can');
    }


    public function dataForEdit(Employee $employee, PositionFilter $pFilter): array
    {
        $branches = Owner::staticBranches()
            ->select(['id', 'title'])
            ->get();

        $employee = $employee->load(
            [
                'branch' => function ($q) {
                    $q->select(['branches.id', 'title']);
                },
                'position' => function ($q) {
                    $q->select(['positions.id', 'title']);
                }
            ]
        );

        if ($filter['branchId'] = request('branch_id')) {
            $positions = Position::filter($pFilter)
                ->select(['id', 'title'])
                ->get();
        } else {
            $positions = Position::where('branch_id', $employee->branch_id)
                ->select(['id', 'title'])
                ->get();
        }

        return compact('branches', 'employee', 'filter', 'positions');
    }
}
