<?php

namespace App\Http\Controllers;

use App\Filters\EmployeeFilter;
use App\Http\Requests\Employee\HireRequest;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Employee\Employee;
use App\Models\User\User;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $employeeService) {}


    public function index(EmployeeFilter $filter)
    {
        $data = $this->employeeService->dataForIndex($filter);


        return Inertia::render('Employee/Index', $data);
    }


    public function show(Employee $employee) {}


    public function create()
    {
        $data = $this->employeeService->dataForCreate();

        $data['user'] = session('user');

        return Inertia::render('Employee/Create', $data);
    }


    public function store(StoreRequest $request) {}


    public function hire(User $user)
    {
        $data = $this->employeeService->dataForCreate();

        $data['user'] = $user;

        return Inertia::render('Employee/Hire', $data);
    }


    public function hireStore(HireRequest $request) {}


    public function edit(Employee $employee) {}


    public function update(UpdateRequest $request, Employee $employee) {}


    public function destroy(Employee $employee) {}
}
