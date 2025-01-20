<?php

namespace Database\Seeders;

use App\Models\Employee\Employee;
use App\Models\Employee\Workday\Workday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::all()->each(function (Employee $employee, int $key) {
            Workday::factory()->create([
                'employee_id' => $employee->id
            ]);
        });
    }
}
