<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'admin',
            'email'      => 'admin@admin.com',
            'password'   => \bcrypt('password'),
        ]);

        $user->assignRole('super_admin');

        User::create([
            'first_name' => 'test',
            'family_name' => 'user',
            'email' => 'user@test.com',
            'password' => \bcrypt('123456'),
            'address' => 'test address',
            'mobile' => '123456789',
            'phone' => '123456789',
            'country_id' => 1,
            'city_id' => 1,
        ]);

    }
}
