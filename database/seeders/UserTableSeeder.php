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
        User::create([
            'first_name' => 'John',
            'family_name' => 'Doe',
            'email' => 'mahmoud@gmail.com',
            'password' => bcrypt('password'),
            'address' => 'Egypt',
            'phone' => '0123456789',
            'mobile' => '0123456789',
            'country' => 'Egypt',
            'city' => 'Cairo',
        ]);
    }
}
