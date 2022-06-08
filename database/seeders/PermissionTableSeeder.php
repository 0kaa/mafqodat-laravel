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
        ]);
    }
}
