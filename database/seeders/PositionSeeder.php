<?php

namespace Database\Seeders;

use App\Models\Employee\Position;
use App\Models\Owner\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::all()->each(function (Branch $branch, int $key) {
            Position::insert([
                [
                    'title' => 'Junior',
                    'branch_id' => $branch->id
                ],
                [
                    'titlte' => 'Middle',
                    'branch_id' => $branch->id
                ],
                [
                    'title' => 'Senior',
                    'branch_id' => $branch->id
                ]
            ]);
        });        
    }
}
