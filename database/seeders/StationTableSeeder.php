<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Station::insert([
            [
                'type'     => 'metro',
                'name_ar'  => 'محطة الرياض',
                'name_en'  => 'Riyadh Station',
                'number'   => '123456',
                'location' => 'الرياض',
                'lat'      => '24.799466899606674',
                'lng'      => '46.83427941618037'
            ]
        ]);
    }
}
