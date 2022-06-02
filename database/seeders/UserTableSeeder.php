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
            'first_name' => 'super',
            'family_name' => 'admin',
            'email'      => 'admin@gmail.com',
            'password'   => \bcrypt('password'),
        ]);

        $user->assignRole('super_admin');

        $employee = User::create([
            'first_name' => 'test',
            'family_name' => 'user',
            'email' => 'user@test.com',
            'password' => \bcrypt('123456'),
            'address' => 'test address',
            'phone' => '123456789',
            'city_id' => 1,
            'job_number' => '123456789',
            'date_of_hiring' => '2022-06-02 00:00:00',
            'working_period' => 'morning',
        ]);

        $employee->givePermissionTo(['create_employee', 'update_employee', 'delete_employee', 'create_category', 'update_category', 'delete_category', 'create_country', 'update_country', 'delete_country', 'create_city', 'update_city', 'delete_city', 'create_station', 'update_station', 'delete_station', 'create_item', 'update_item', 'delete_item']);

    }
}
