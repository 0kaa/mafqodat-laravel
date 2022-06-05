<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'name'       => 'create_employee',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_employee',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_employee',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_category',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_category',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_category',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_country',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_country',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_country',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_city',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_city',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_city',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_station',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_station',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_station',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_item',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_item',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_item',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_storage',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_storage',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_storage',
                'guard_name' => 'web',
            ],

        ]);
    }
}
