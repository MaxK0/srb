<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtraDay\StoreRequest;
use App\Http\Requests\WorklessDay\UpdateRequest;
use App\Models\Employee\Employee;
use App\Models\Employee\Workday\ExtraDay;
use App\Models\Employee\Workday\Workday;
use Illuminate\Http\Request;

class ExtraDayController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd();
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
    public function edit(Employee $employee, Workday $workday, ExtraDay $extraDay)
    {
        dd();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateRequest $request,
        Employee $employee,
        Workday $workday,
        ExtraDay $extraDay
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, Workday $workday, ExtraDay $extraDay)
    {
        dd($extraDay);
    }
}
