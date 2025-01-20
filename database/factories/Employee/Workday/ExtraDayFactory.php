<?php

namespace Database\Factories\Employee\Workday;

use App\Models\Employee\Workday\Workday;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee\Workday\ExtraDay>
 */
class ExtraDayFactory extends Factory
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
            'date_end' => now()->addMonth(1),
            'time_start' => fake()->time(),
            'time_end' => fake()->time(),
            'workday_id' => Workday::factory()
        ];
    }
}
