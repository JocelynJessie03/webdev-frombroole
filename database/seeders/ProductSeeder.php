<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Menggunakan magic method where[NamaKolom]
        $catBroole = Category::whereCategoryName('Broole Series')->first()->id;
        $catDrinks = Category::whereCategoryName('Drinks')->first()->id;
        $catCheese = Category::whereCategoryName('Cheese Cake Series')->first()->id;

        // 2. Ambil Mapping ID Ingredients (Nama => ID)
        $ing = Ingredient::pluck('id', 'name');

        // 3. Daftar Produk Lengkap
        $products = [
            // --- BROOLE SERIES (Original) ---
            [
                'name' => 'Broole Original Topping Oreo',
                'price' => 25000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Original Topping Regal',
                'price' => 25000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Original Topping Strawberry',
                'price' => 25000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- BROOLE SERIES (Chocolate) ---
            [
                'name' => 'Broole Chocolate Topping Oreo',
                'price' => 27000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>5], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Chocolate Topping Regal',
                'price' => 27000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>5], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Chocolate Topping Strawberry',
                'price' => 27000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>5], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- BROOLE SERIES (Matcha) ---
            [
                'name' => 'Broole Matcha Topping Oreo',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Matcha Topping Regal',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Matcha Topping Strawberry',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- BROOLE SERIES (Tiramisu) ---
            [
                'name' => 'Broole Tiramisu Topping Oreo',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>3], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Coffee Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Tiramisu Topping Regal',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>3], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Coffee Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Tiramisu Topping Strawberry',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>3], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Coffee Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- BROOLE SERIES (Thai Tea) ---
            [
                'name' => 'Broole Thai Tea Topping Oreo',
                'price' => 26000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Thaitea Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Thai Tea Topping Regal',
                'price' => 26000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Thaitea Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Thai Tea Topping Strawberry',
                'price' => 26000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Thaitea Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- DRINKS ---
            [
                'name' => 'Sea Salt Butterscotch Coffee',
                'price' => 22000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>120], ['n'=>'Sugar', 'a'=>15], ['n'=>'Salt', 'a'=>2], ['n'=>'Heavy Cream', 'a'=>30], ['n'=>'Coffee Powder', 'a'=>10], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Sea Salt Butterscotch Chocolate',
                'price' => 22000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>120], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>30], ['n'=>'Salt', 'a'=>2], ['n'=>'Heavy Cream', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Sea Salt Butterscotch Matcha',
                'price' => 22000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>120], ['n'=>'Sugar', 'a'=>15], ['n'=>'Matcha Powder', 'a'=>7], ['n'=>'Salt', 'a'=>2], ['n'=>'Heavy Cream', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Strawberry Matcha Latte',
                'price' => 23000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>150], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Strawberry Jam', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Matcha Latte',
                'price' => 20000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>180], ['n'=>'Matcha Powder', 'a'=>20], ['n'=>'Sugar', 'a'=>10], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Hazelnut Coffee',
                'price' => 20000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>180], ['n'=>'Sugar', 'a'=>5], ['n'=>'Cocoa Powder', 'a'=>5], ['n'=>'Coffee Powder', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Milk Tea',
                'price' => 15000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>100], ['n'=>'Sugar', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Strawberry Latte',
                'price' => 20000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>180], ['n'=>'Sugar', 'a'=>45], ['n'=>'Strawberry Jam', 'a'=>5], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],

            // --- CHEESECAKE SERIES ---
            [
                'name' => 'Cheesecake Original',
                'price' => 35000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Chocolate',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Cocoa Powder', 'a'=>30], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Matcha',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Strawberry',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Strawberry Jam', 'a'=>30], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Blueberry',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Blueberry Jam', 'a'=>15], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Tiramisu',
                'price' => 40000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Coffee Powder', 'a'=>5],['n'=>'Cocoa Powder', 'a'=>3], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Oreo',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Oreo', 'a'=>2], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
        ];

        // 4. Proses Insert ke Database
                foreach ($products as $pData) {
            // Pastikan kategori ada
            if (!$pData['cat']) continue;

            // Cara Generate ID yang lebih aman dari duplikat:
            // Menggunakan 3 huruf pertama + 3 huruf terakhir (tanpa spasi) + random 4 digit
            $cleanName = str_replace(' ', '', $pData['name']);
            $uniqueCode = strtoupper(substr($cleanName, 0, 3) . substr($cleanName, -3));
            $generatedID = 'PRO-' . $uniqueCode . '-' . str_pad(Product::count() + 1, 3, '0', STR_PAD_LEFT); // PRO-XXX0001, PRO-XXX0002, dst.
            
            $product = Product::create([
                'pro_ID'      => $generatedID,
                'pro_name'    => $pData['name'],
                'pro_price'   => $pData['price'],
                'category_id' => $pData['cat'],
                'pro_image'   => $pData['name'] . '.png',
            ]);

            // Tambahkan relasi bahan baku ke tabel pivot
            foreach ($pData['recipe'] as $item) {
                $product->ingredients()->attach($ing[$item['n']], [
                    'amount_needed' => $item['a']
                ]);
            }
        }
    }
}