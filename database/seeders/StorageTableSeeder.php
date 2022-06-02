<?php

namespace Database\Seeders;

use App\Models\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::insert([
            [
                'name_ar' => 'المخزن الرئيسي',
                'name_en' => 'Main Storage',
                'category_id' => 1,
            ],
            [
                'name_ar' => 'المخزن الثانوي',
                'name_en' => 'Secondary Storage',
                'category_id' => 2,
            ],
        ]);
    }
}
