<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Employee\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $employeeService) {}


    public function index() {}


    public function show(Employee $employee) {}


    public function create() {}


    public function store(StoreRequest $request) {}


    public function edit(Employee $employee) {}


    public function update(UpdateRequest $request, Employee $employee) {}


    public function destroy(Employee $employee) {}
}
