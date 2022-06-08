<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'name_ar'    => 'الاجهزة الالكترونية',
                'name_en'    => 'Electronics',
                'image'      => 'categories/devices.png',
                'slug'       => 'electronics',
                'storage_id' => 1,
            ],
            [
                'name_ar'    => 'اكسسورات',
                'name_en'    => 'Accessories',
                'image'      => 'categories/accessories.png',
                'slug'       => 'accessories',
                'storage_id' => 2,
            ],
            [
                'name_ar'    => 'مقتنيات ثمينة',
                'name_en'    => 'Jewelry',
                'image'      => 'categories/jewelry.png',
                'slug'       => 'jewelry',
                'storage_id' => 3,
            ],
            [
                'name_ar'    => 'كتب و مستندات',
                'name_en'    => 'Books',
                'image'      => 'categories/books.png',
                'slug'       => 'books',
                'storage_id' => 4,
            ],
            [
                'name_ar'    => 'نقود',
                'name_en'    => 'Money',
                'image'      => 'categories/money.png',
                'slug'       => 'money',
                'storage_id' => 5,
            ],
            [
                'name_ar'    => 'أخرى',
                'name_en'    => 'Other',
                'image'      => 'categories/other.png',
                'slug'       => 'other',
                'storage_id' => 6,
            ],
        ]);
    }
}
