<?php

namespace Database\Factories\Employee\Workday;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee\Workday\Workday>
 */
class WorkdayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_start' => now(),
            'days_work' => rand(1, 7),
            'days_rest' => rand(1, 7),
            'time_start' => fake()->time(),
            'time_end' => fake()->time(),
            'employee_id' => Employee::factory()
        ];
    }
}
