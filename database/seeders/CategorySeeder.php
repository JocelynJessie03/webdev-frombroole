<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Pastikan memanggil Model Category

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Broole Series'],
            ['category_name' => 'Drinks'],
            ['category_name' => 'Cheese Cake Series'],
        ];

        foreach ($categories as $category) {
            $category['category_ID'] = 'CAT-' . str_pad(array_search($category, $categories) + 1, 3, '0', STR_PAD_LEFT);
            Category::create($category);
        }
    }
}