<?php

namespace App\Services;

use App\Models\Employee\Employee;
use App\Models\Employee\Workday\Workday;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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


    public function dataWorkday(Employee $employee): array
    {
        $workday = $employee->workday;

        return compact('workday');
    }


    public function dataForShow(Employee $employee): array
    {
        return $this->dataWorkday($employee);
    }


    public function dataForEdit(Employee $employee): array
    {
        return $this->dataWorkday($employee);
    }


    public function store(array $data, Employee $employee)
    {
        $data['employee_id'] = $employee->id;

        $data['time_start'] = Carbon::parse($data['time_start'])->toTimeString('minutes');
        $data['time_end'] = Carbon::parse($data['time_end'])->toTimeString('minutes');

        $this->create($data);
    }


    public function update(Model $model, array|Collection $data): bool
    {
        if (! is_array($data) && $data instanceof Collection) $data = $data->all();

        $data['time_start'] = Carbon::parse($data['time_start'])->toTimeString('minutes');
        $data['time_end'] = Carbon::parse($data['time_end'])->toTimeString('minutes');

        return $model->update($data);
    }
}
