<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtraDay\StoreRequest;
use App\Http\Requests\WorklessDay\UpdateRequest;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Workday $workday)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ExtraDay $extraDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExtraDay $extraDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ExtraDay $extraDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExtraDay $extraDay)
    {
        //
    }
}
