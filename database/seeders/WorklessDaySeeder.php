<?php

namespace Database\Seeders;

use App\Models\Employee\Workday\WorklessDay;
use Illuminate\Database\Seeder;

class WorklessDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorklessDay::factory()->create([
            'workday_id' => 2
        ]);
    }
}
