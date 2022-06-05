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
                'name_ar' => 'مخزن الالكترونيات',
                'name_en' => 'Electronic Storage',
            ],
            [
                'name_ar' => 'مخزن الاكسسوارات',
                'name_en' => 'Accessories Storage',
            ],
            [
                'name_ar' => 'مخزن مقتنيات ثمينة',
                'name_en' => 'Jewelry Storage',
            ],
            [
                'name_ar' => 'مخزن كتب و مستندات',
                'name_en' => 'Books Storage',
            ],
            [
                'name_ar' => 'مخزن نقود',
                'name_en' => 'Money Storage',
            ],
            [
                'name_ar' => 'مخزن أخرى',
                'name_en' => 'Other Storage',
            ],

        ]);
    }
}
