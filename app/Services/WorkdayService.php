<?php

namespace App\Services;

use App\Models\Employee\Employee;
use App\Models\Employee\Workday\Workday;
use Carbon\Carbon;

class WorkdayService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Workday::class);
    }


    public function dataForCreate(Employee $employee): array
    {
        $employee = $employee->load([
            'user' => fn($q) => $q->select('id', 'name', 'lastname', 'patronymic')
        ]);

        $employeeArray['id'] = $employee->id;
        $employeeArray['fio_short'] = $employee->user->fio_short;

        return [
            'employee' => $employeeArray
        ];
    }


    public function dataForShow(): array
    {
        return [];
    }


    public function dataForEdit(Workday $workday): array
    {
        return [
            'workday' => $workday
        ];
    }


    public function store(array $data, Employee $employee)
    {
        $data['employee_id'] = $employee->id;

        $data['time_start'] = Carbon::parse($data['time_start'])->toTimeString('minutes');
        $data['time_end'] = Carbon::parse($data['time_end'])->toTimeString('minutes');
        
        $this->create($data);
    }
}
