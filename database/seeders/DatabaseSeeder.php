<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(StorageTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(StationTableSeeder::class);
        $this->call(UserTableSeeder::class);

    }
}
