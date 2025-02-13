<?php

namespace App\Http\Controllers;

use App\Http\Requests\Workday\StoreRequest;
use App\Http\Requests\Workday\UpdateRequest;
use App\Models\Employee\Employee;
use App\Models\Employee\Workday\Workday;
use App\Services\WorkdayService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkdayController extends Controller
{
    public function __construct(protected WorkdayService $workdayService) {}


    public function create(Employee $employee)
    {
        $data = $this->workdayService->dataForCreate($employee);

        return Inertia::render('Workday/Create', $data);
    }


    public function store(StoreRequest $request, Employee $employee)
    {
        $data = $request->validated();

        $this->workdayService->store($data, $employee);

        return redirect()->route('employees.show', $employee);
    }


    public function show(Employee $employee)
    {
        $data = $this->workdayService
            ->dataForShow($employee);

        return Inertia::render('Workday/Show', $data);
    }


    public function edit(Employee $employee)
    {
        $data = $this->workdayService->dataForEdit($employee);

        return Inertia::render('Workday/Edit', $data);
    }


    public function update(UpdateRequest $request, Employee $employee)
    {
        $data = $request->validated();

        $this->workdayService
            ->update($employee->workday, $data);

        return redirect()->route('employees.show', $employee);
    }


    public function destroy(Employee $employee)
    {
        $this->workdayService
            ->delete($employee->workday);

        return redirect()->route('employees.show', $employee->id);
    }
}
