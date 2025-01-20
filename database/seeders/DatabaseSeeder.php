<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CitySeeder::class,
            UserSeeder::class,
            BusinessSeeder::class,
            BranchSeeder::class,
            PositionSeeder::class,
            EmployeeSeeder::class,
            WorklessStatusSeeder::class,
            WorkdaySeeder::class,
            ExtraDaySeeder::class,
            WorklessDaySeeder::class
        ]);
    }
}
