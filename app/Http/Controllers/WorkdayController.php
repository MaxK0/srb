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


    public function show(Employee $employee, Workday $workday) {}


    public function edit(Employee $employee, Workday $workday)
    {
        $data = $this->workdayService->dataForEdit($workday);

        return Inertia::render('Workday/Edit', $data);
    }


    public function update(UpdateRequest $request, Employee $employee, Workday $workday)
    {
        $data = $request->validated();

        $workday->update($data);
        return redirect()->route('employees.show', $employee);


        dd($data);
    }


    public function destroy(Employee $employee, Workday $workday) {}
}
