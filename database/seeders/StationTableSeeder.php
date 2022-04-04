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
                'details'  => 'تفاصيل',
                'location' => 'الرياض',
                'lat'      => '24.774265',
                'lng'      => '46.738586'
            ]
        ]);
    }
}
