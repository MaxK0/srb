<?php

namespace Database\Factories\Owner;

use App\Models\City;
use App\Models\Owner\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2),
            'address' => fake()->address(),
            'city_id' => City::inRandomOrder()->first()->id,
            'business_id' => Business::inRandomOrder()->first()->id,
            'information' => fake()->paragraph()
        ];
    }
}
