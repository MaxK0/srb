<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'admin',
            'lastname' => 'admin',  
            'patronymic' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '9999999999',
            'sex' => 'м',
            'password' => Hash::make('adminadmin')
        ]);

        $user->roles()
            ->attach(User::OWNER_ID);

        $user->owner()->create();

        User::factory(20)->create();
    }
}
