<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'desc' => 'A classic and creamy dessert featuring our signature broole base, topped with crunchy Oreo crumbles for the perfect bite.',
                'price' => 25000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Original Topping Regal',
                'desc' => 'Our signature creamy broole base generously layered with classic Marie Regal biscuit crumbles, bringing a nostalgic sweetness.',
                'price' => 25000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Original Topping Strawberry',
                'desc' => 'Signature creamy broole perfectly paired with sweet and tangy strawberry jam for a refreshing dessert experience.',
                'price' => 25000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- BROOLE SERIES (Chocolate) ---
            [
                'name' => 'Broole Chocolate Topping Oreo',
                'desc' => 'Rich and indulgent chocolate broole topped with delightful Oreo crumbles. A chocolate lover\'s dream.',
                'price' => 27000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>5], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Chocolate Topping Regal',
                'desc' => 'Decadent chocolate broole combined with classic Regal biscuit crumbles for an exquisite taste and texture.',
                'price' => 27000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>5], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Chocolate Topping Strawberry',
                'desc' => 'The ultimate combination of rich chocolate broole and fresh, sweet strawberry jam.',
                'price' => 27000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>5], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- BROOLE SERIES (Matcha) ---
            [
                'name' => 'Broole Matcha Topping Oreo',
                'desc' => 'Premium matcha infused broole perfectly balanced with crunchy and sweet Oreo crumbles.',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Matcha Topping Regal',
                'desc' => 'Earthy and aromatic matcha broole topped with nostalgic Marie Regal crumbles.',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Matcha Topping Strawberry',
                'desc' => 'A beautiful contrast of earthy matcha broole and bright, fruity strawberry jam.',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- BROOLE SERIES (Tiramisu) ---
            [
                'name' => 'Broole Tiramisu Topping Oreo',
                'desc' => 'Classic Italian-inspired tiramisu broole mixed with a twist of Oreo crumbles.',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>3], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Coffee Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Tiramisu Topping Regal',
                'desc' => 'A sophisticated tiramisu broole enriched with the timeless taste of Regal biscuits.',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>3], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Coffee Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Tiramisu Topping Strawberry',
                'desc' => 'Tiramisu broole with an unexpected but delightful touch of sweet strawberry jam.',
                'price' => 28000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>3], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Coffee Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- BROOLE SERIES (Thai Tea) ---
            [
                'name' => 'Broole Thai Tea Topping Oreo',
                'desc' => 'Authentic Thai Tea flavored broole blended seamlessly with classic Oreo crumbles.',
                'price' => 26000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Oreo', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Thaitea Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Thai Tea Topping Regal',
                'desc' => 'A fragrant Thai Tea broole paired with crunchy, sweet Marie Regal biscuits.',
                'price' => 26000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Regal', 'a'=>1], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Thaitea Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Broole Thai Tea Topping Strawberry',
                'desc' => 'A unique fusion of spiced Thai Tea broole and luscious strawberry jam.',
                'price' => 26000, 'cat' => $catBroole,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>15], ['n'=>'Strawberry Jam', 'a'=>15], ['n'=>'Heavy Cream', 'a'=>125], ['n'=>'Thaitea Powder', 'a'=>5], ['n'=>'Alumunium', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],

            // --- DRINKS ---
            [
                'name' => 'Sea Salt Butterscotch Coffee',
                'desc' => 'A perfect balance of bold coffee, creamy butterscotch, and a hint of savory sea salt.',
                'price' => 22000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>120], ['n'=>'Sugar', 'a'=>15], ['n'=>'Salt', 'a'=>2], ['n'=>'Heavy Cream', 'a'=>30], ['n'=>'Coffee Powder', 'a'=>10], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Sea Salt Butterscotch Chocolate',
                'desc' => 'Rich, velvety chocolate drink enhanced by sweet butterscotch and sea salt.',
                'price' => 22000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>120], ['n'=>'Sugar', 'a'=>15], ['n'=>'Cocoa Powder', 'a'=>30], ['n'=>'Salt', 'a'=>2], ['n'=>'Heavy Cream', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Sea Salt Butterscotch Matcha',
                'desc' => 'Earthy matcha latte elevated with creamy butterscotch and a touch of sea salt.',
                'price' => 22000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>120], ['n'=>'Sugar', 'a'=>15], ['n'=>'Matcha Powder', 'a'=>7], ['n'=>'Salt', 'a'=>2], ['n'=>'Heavy Cream', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Strawberry Matcha Latte',
                'desc' => 'A visually stunning and delicious mix of premium matcha and fresh strawberry jam.',
                'price' => 23000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>150], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Strawberry Jam', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Matcha Latte',
                'desc' => 'Classic, creamy, and authentic matcha latte made with high-quality matcha powder.',
                'price' => 20000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>180], ['n'=>'Matcha Powder', 'a'=>20], ['n'=>'Sugar', 'a'=>10], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Hazelnut Coffee',
                'desc' => 'A nutty, comforting coffee drink featuring aromatic hazelnut notes.',
                'price' => 20000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>180], ['n'=>'Sugar', 'a'=>5], ['n'=>'Cocoa Powder', 'a'=>5], ['n'=>'Coffee Powder', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Milk Tea',
                'desc' => 'Sweet, creamy, and deeply satisfying traditional milk tea over ice.',
                'price' => 15000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>100], ['n'=>'Sugar', 'a'=>30], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],
            [
                'name' => 'Strawberry Latte',
                'desc' => 'A fruity, milky delight made with real strawberry jam and fresh milk.',
                'price' => 20000, 'cat' => $catDrinks,
                'recipe' => [['n'=>'Milk', 'a'=>180], ['n'=>'Sugar', 'a'=>45], ['n'=>'Strawberry Jam', 'a'=>5], ['n'=>'Ice Cube', 'a'=>120], ['n'=>'Cup', 'a'=>1], ['n'=>'Straw', 'a'=>1]]
            ],

            // --- CHEESECAKE SERIES ---
            [
                'name' => 'Cheesecake Original',
                'desc' => 'Our signature, incredibly smooth original cheesecake with a buttery crumb base.',
                'price' => 35000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Chocolate',
                'desc' => 'A dense, fudgy chocolate cheesecake that melts in your mouth.',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Cocoa Powder', 'a'=>30], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Matcha',
                'desc' => 'A delicate fusion of creamy cheesecake and premium Japanese matcha.',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Matcha Powder', 'a'=>5], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Strawberry',
                'desc' => 'Classic cheesecake topped with a generous layer of sweet strawberry compote.',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Strawberry Jam', 'a'=>30], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Blueberry',
                'desc' => 'Rich cheesecake complemented by a tangy and sweet blueberry topping.',
                'price' => 38000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Blueberry Jam', 'a'=>15], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Tiramisu',
                'desc' => 'A beautiful marriage of creamy cheesecake and coffee-soaked tiramisu flavors.',
                'price' => 40000, 'cat' => $catCheese,
                'recipe' => [['n'=>'Egg', 'a'=>1], ['n'=>'Sugar', 'a'=>30], ['n'=>'Coffee Powder', 'a'=>5],['n'=>'Cocoa Powder', 'a'=>3], ['n'=>'Vanilla Syrup', 'a'=>5], ['n'=>'Regal', 'a'=>3], ['n'=>'Heavy Cream', 'a'=>60], ['n'=>'Cream Cheese', 'a'=>125], ['n'=>'Paper Box', 'a'=>1], ['n'=>'Spork', 'a'=>1]]
            ],
            [
                'name' => 'Cheesecake Oreo',
                'desc' => 'Creamy cheesecake packed and topped with generous amounts of crushed Oreos.',
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
            $banyakProduct = DB::table('products')->count();
            $generatedID = 'PRO-' . $uniqueCode . '-' . str_pad($banyakProduct + 1, 3, '0', STR_PAD_LEFT); // PRO-XXX0001, PRO-XXX0002, dst.
            
            $product = Product::create([
                'pro_ID'          => $generatedID,
                'pro_name'        => $pData['name'],
                'pro_description' => $pData['desc'] ?? null,
                'pro_price'       => $pData['price'],
                'category_id'     => $pData['cat'],
                'pro_image'       => $pData['name'] . '.jpg',
            ]);

            // Tambahkan relasi bahan baku ke tabel pivot
            foreach ($pData['recipe'] as $item) {
                $product->ingredients()->attach($ing[$item['n']], [
                    'id' => \Illuminate\Support\Str::uuid(),
                    'amount_needed' => $item['a']
                ]);
            }
        }
    }
}