<?php

namespace Database\Seeders;

use App\Models\Employee\Workday\Timework;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $startTime = Carbon::create(2024, 1, 1, 0, 0, 0); // Начальное время
        $endTime = Carbon::create(2024, 1, 2, 23, 55, 0); // Конечное время

        Timework::query()->delete();

        while ($startTime <= $endTime && $startTime < Carbon::create(2024, 1, 2, 0, 0, 0)) {
            $startTimeChange = $startTime->copy();

            while ($startTimeChange <= $endTime && $startTimeChange < $startTime->copy()->addDay()) {
                $startTimeChange->addMinutes(5);

                Timework::create([
                    'start' => $startTime->copy(),
                    'end' => $startTimeChange->copy(),
                ]);
            }
            $startTime->addMinute(5);
        }
    }
}
