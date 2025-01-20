<?php

namespace Database\Seeders;

use App\Models\Employee\Workday\ExtraDay;
use App\Models\Employee\Workday\Workday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExtraDay::factory()->create([
            'workday_id' => Workday::first()->id
        ]);
    }
}
