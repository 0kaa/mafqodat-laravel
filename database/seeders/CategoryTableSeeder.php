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
                'name_ar' => 'جوال',
                'name_en' => 'Mobile',
                'image'   => 'categories/devices.png',
                'slug'    => 'mobile',
            ],
            [
                'name_ar' => 'اكسسورات',
                'name_en' => 'Electronics',
                'image'   => 'categories/electronics.png',
                'slug'    => 'electronics',
            ],
            [
                'name_ar' => 'مقتنيات ذهبية',
                'name_en' => 'Jewelry',
                'image'   => 'categories/jewelry.png',
                'slug'    => 'jewelry',
            ],
            [
                'name_ar' => 'كتب و مستندات',
                'name_en' => 'Books',
                'image'   => 'categories/books.png',
                'slug'    => 'books',
            ],
            [
                'name_ar' => 'نقود',
                'name_en' => 'Money',
                'image'   => 'categories/money.png',
                'slug'    => 'money',
            ],
            [
                'name_ar' => 'أخرى',
                'name_en' => 'Other',
                'image'   => 'categories/other.png',
                'slug'    => 'other',
            ],
        ]);
    }
}
