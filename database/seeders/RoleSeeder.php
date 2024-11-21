<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'title' => 'Владелец'
            ],
            [
                'id' => 2,
                'title' => 'Сотрудник'
            ],
            [
                'id' => 3,
                'title' => 'Клиент'
            ],
        ]);
    }
}
