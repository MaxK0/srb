<?php

namespace Database\Factories\Employee\Workday;

use App\Models\Employee\Workday\Workday;
use App\Models\Employee\Workday\WorklessStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee\Workday\WorklessDay>
 */
class WorklessDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start' => now(),
            'end' => now()->addMonth(1),
            'status_id' => WorklessStatus::inRandomOrder()->first()->id,
            'workday_id' => Workday::factory()
        ];
    }
}
