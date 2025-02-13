<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorklessDay\StoreRequest;
use App\Http\Requests\WorklessDay\UpdateRequest;
use App\Models\Employee\Employee;
use App\Models\Employee\Workday\Workday;
use App\Models\Employee\Workday\WorklessDay;
use Illuminate\Http\Request;

class WorklessDayController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Employee $employee, Workday $workday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee, Workday $workday, WorklessDay $worklessDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateRequest $request,
        Employee $employee,
        Workday $workday,
        WorklessDay $worklessDay
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, Workday $workday, WorklessDay $worklessDay)
    {
        //
    }
}
