<?php

namespace Database\Seeders;

use App\Models\Employee\Workday\WorklessDay;
use App\Models\Owner\Branch;
use App\Models\Owner\Business;
use Illuminate\Database\Seeder;

class WorklessDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorklessDay::factory()->create([
            'workday_id' => Business::first()
            ->branches()
            ->first()
            ->employees()
            ->first()
            ->workday
            ->id
        ]);
    }
}
