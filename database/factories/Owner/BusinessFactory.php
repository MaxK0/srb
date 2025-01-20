<?php

namespace Database\Factories\Owner;

use App\Models\Owner\Business;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner\Business>
 */
class BusinessFactory extends Factory
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
            'information' => fake()->paragraph(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Business $business) {
            $business->owners()
                ->attach(User::first()->id);
        });
    }
}
