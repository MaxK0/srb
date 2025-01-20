<?php

namespace Database\Seeders;

use App\Models\Employee\Workday\WorklessStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorklessStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorklessStatus::insert([
            [
                'title' => 'Выходной'
            ],
            [
                'title' => 'Праздник'
            ],
            [
                'title' => 'Болезнь'
            ],
            [
                'title' => 'Другая причина'
            ]
        ]);
    }
}
