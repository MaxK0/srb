<?php

namespace App\Http\Controllers;

use App\Filters\EmployeeFilter;
use App\Filters\PositionFilter;
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


    public function index(Request $request, EmployeeFilter $filter)
    {
        $data = $this->employeeService->dataForIndex($filter, $request->get('perPage', 25));

        return Inertia::render('Employee/Index', $data);
    }


    public function show(Employee $employee)
    {
        $data = $this->employeeService->dataForShow($employee);

        return Inertia::render('Employee/Show', $data);
    }


    public function create(PositionFilter $filter)
    {
        $data = $this->employeeService->dataForCreate($filter);

        $data['user'] = session('user');

        return Inertia::render('Employee/Create', $data);
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->employeeService->createWithUser($data);

        return redirect()->route('employees.index');
    }


    public function edit(Employee $employee, PositionFilter $filter)
    {
        $data = $this->employeeService->dataForEdit($employee, $filter);

        return Inertia::render('Employee/Edit', $data);
    }


    public function update(UpdateRequest $request, Employee $employee)
    {
        $data = $request->validated();

        $this->employeeService->update($employee, $data);

        return redirect()->route('employees.index');
    }


    public function destroy(Employee $employee)
    {
        $this->employeeService->delete($employee);

        return redirect()->route('employees.index');
    }


    public function destroyWithoutRedirect(Employee $employee)
    {
        $this->employeeService->delete($employee);
    }
}
