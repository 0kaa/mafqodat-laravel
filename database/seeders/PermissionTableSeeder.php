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
                'name'       => 'create_countries',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_countries',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_countries',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_cities',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_cities',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_cities',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_stations',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_stations',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_stations',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'create_items',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'update_items',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'delete_items',
                'guard_name' => 'web',
            ],

        ]);
    }
}
