<?php

namespace Database\Factories\Employee;

use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\Owner\Branch;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'work_phone' => fake()->numberBetween(1000000000, 9999999999),
            'user_id' => User::factory(),
            'branch_id' => Branch::inRandomOrder()->first()->id
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Employee $employee) {
            $user = $employee->user;

            $user->roles()
                ->attach(User::EMPLOYEE_ID);

            $positionId = $employee->branch
                ->positions()
                ->inRandomOrder()
                ->first()
                ->id;

            $employee->update([
                'position_id' => $positionId
            ]);
        });
    }
}
