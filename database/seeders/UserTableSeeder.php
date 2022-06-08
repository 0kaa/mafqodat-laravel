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
            'name' => 'super Admin',
            'email'      => 'admin@gmail.com',
            'password'   => \bcrypt('password'),
        ]);

        $user->assignRole('super_admin');

        $employee = User::create([
            'name' => 'test user',
            'email' => 'user@test.com',
            'password' => \bcrypt('123456'),
            'phone' => '123456789',
            'job_number' => '123456789',
            'date_of_hiring' => '2022-06-02 00:00:00',
            'working_period' => 'morning',
        ]);

        $employee->givePermissionTo(['create_item', 'update_item', 'delete_item']);

    }
}
