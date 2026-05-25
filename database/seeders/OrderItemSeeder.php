<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil semua data produk langsung menggunakan DB Query Builder (Nama => [ID, Harga])
        $productsData = DB::table('products')->get();
        
        $products = [];
        $prices = [];
        
        foreach ($productsData as $product) {
            // Mapping nama produk ke ID dan Harga berdasarkan kolom tabel Anda
            $products[$product->pro_name] = $product->id;
            $prices[$product->id] = $product->pro_price;
        }

        // 2. Blueprint item transaksi (Tetap sama seperti bawaan Anda)
        $blueprints = [
            // Budi Santoso (CUST-0001)
            [['n' => 'Cheesecake Tiramisu', 'q' => 2], ['n' => 'Cheesecake Oreo', 'q' => 3]],
            [['n' => 'Broole Original Topping Oreo', 'q' => 2], ['n' => 'Strawberry Latte', 'q' => 2]],
            [['n' => 'Broole Chocolate Topping Regal', 'q' => 3], ['n' => 'Milk Tea', 'q' => 3]],
            [['n' => 'Cheesecake Original', 'q' => 1], ['n' => 'Sea Salt Butterscotch Coffee', 'q' => 2]],
            [['n' => 'Cheesecake Blueberry', 'q' => 1], ['n' => 'Hazelnut Coffee', 'q' => 1]],

            // Siti Aminah (CUST-0002)
            [['n' => 'Cheesecake Matcha', 'q' => 1], ['n' => 'Matcha Latte', 'q' => 2]],
            [['n' => 'Broole Matcha Topping Oreo', 'q' => 2], ['n' => 'Sea Salt Butterscotch Matcha', 'q' => 2]],
            [['n' => 'Cheesecake Tiramisu', 'q' => 3], ['n' => 'Hazelnut Coffee', 'q' => 2]],
            [['n' => 'Cheesecake Original', 'q' => 1]],

            // Andi Wijaya (CUST-0003)
            [['n' => 'Matcha Latte', 'q' => 2]],
            [['n' => 'Cheesecake Oreo', 'q' => 2], ['n' => 'Milk Tea', 'q' => 2]],

            // Dewi Lestari (CUST-0005)
            [['n' => 'Cheesecake Chocolate', 'q' => 4], ['n' => 'Strawberry Matcha Latte', 'q' => 4]],
            [['n' => 'Broole Tiramisu Topping Regal', 'q' => 3], ['n' => 'Sea Salt Butterscotch Chocolate', 'q' => 2]],
            [['n' => 'Cheesecake Strawberry', 'q' => 2], ['n' => 'Strawberry Latte', 'q' => 1]],
            [['n' => 'Cheesecake Tiramisu', 'q' => 2]],
            [['n' => 'Broole Thai Tea Topping Oreo', 'q' => 1], ['n' => 'Milk Tea', 'q' => 2]],

            // Rian Hidayat (CUST-0006)
            [['n' => 'Cheesecake Oreo', 'q' => 2], ['n' => 'Broole Original Topping Oreo', 'q' => 2]],
            [['n' => 'Cheesecake Chocolate', 'q' => 2]],
            [['n' => 'Broole Matcha Topping Regal', 'q' => 1], ['n' => 'Strawberry Latte', 'q' => 1]],

            // Eka Putri (CUST-0007)
            [['n' => 'Cheesecake Original', 'q' => 1], ['n' => 'Milk Tea', 'q' => 2]],
            [['n' => 'Broole Tiramisu Topping Oreo', 'q' => 2]],
            [['n' => 'Cheesecake Strawberry', 'q' => 2], ['n' => 'Strawberry Latte', 'q' => 3]],

            // Fajar Nugroho (CUST-0008)
            [['n' => 'Cheesecake Original', 'q' => 5], ['n' => 'Hazelnut Coffee', 'q' => 5]],
            [['n' => 'Broole Chocolate Topping Oreo', 'q' => 3], ['n' => 'Sea Salt Butterscotch Chocolate', 'q' => 2]],
            [['n' => 'Cheesecake Tiramisu', 'q' => 1]],

            // Siti Rahmawati (CUST-0009)
            [['n' => 'Cheesecake Blueberry', 'q' => 2], ['n' => 'Milk Tea', 'q' => 3]],
            [['n' => 'Broole Thai Tea Topping Regal', 'q' => 2], ['n' => 'Sea Salt Butterscotch Coffee', 'q' => 2]],

            // Bambang Pamungkas (CUST-0010)
            [['n' => 'Cheesecake Tiramisu', 'q' => 1]],

            // Aditya Nugraha (CUST-0011)
            [['n' => 'Cheesecake Oreo', 'q' => 6], ['n' => 'Matcha Latte', 'q' => 6]],
            [['n' => 'Broole Original Topping Strawberry', 'q' => 3], ['n' => 'Strawberry Latte', 'q' => 2]],
            [['n' => 'Cheesecake Chocolate', 'q' => 2], ['n' => 'Sea Salt Butterscotch Chocolate', 'q' => 1]],

            // Maya Indah (CUST-0012)
            [['n' => 'Cheesecake Original', 'q' => 2], ['n' => 'Hazelnut Coffee', 'q' => 2]],
            [['n' => 'Broole Matcha Topping Oreo', 'q' => 1], ['n' => 'Strawberry Matcha Latte', 'q' => 1]],

            // Rizky Pratama (CUST-0013)
            [['n' => 'Cheesecake Original', 'q' => 2]],

            // Diana Lestari (CUST-0014)
            [['n' => 'Cheesecake Chocolate', 'q' => 4], ['n' => 'Hazelnut Coffee', 'q' => 3]],
            [['n' => 'Broole Original Topping Regal', 'q' => 2], ['n' => 'Milk Tea', 'q' => 1]],

            // Hendra Wijaya (CUST-0015)
            [['n' => 'Cheesecake Oreo', 'q' => 2], ['n' => 'Milk Tea', 'q' => 3]],
            [['n' => 'Cheesecake Tiramisu', 'q' => 1], ['n' => 'Sea Salt Butterscotch Coffee', 'q' => 1]],

            // Customer 16
            [['n' => 'Cheesecake Original', 'q' => 2], ['n' => 'Matcha Latte', 'q' => 2]],
            [['n' => 'Broole Chocolate Topping Oreo', 'q' => 1], ['n' => 'Milk Tea', 'q' => 1]],

            // Siti Badriah (CUST-0017)
            [['n' => 'Cheesecake Oreo', 'q' => 2], ['n' => 'Milk Tea', 'q' => 1]],

            // Guntur Bumi (CUST-0018)
            [['n' => 'Broole Original Topping Oreo', 'q' => 3], ['n' => 'Strawberry Latte', 'q' => 2]],
            [['n' => 'Cheesecake Tiramisu', 'q' => 1], ['n' => 'Hazelnut Coffee', 'q' => 1]],

            // Agnes Monica (CUST-0019)
            [['n' => 'Cheesecake Tiramisu', 'q' => 5], ['n' => 'Matcha Latte', 'q' => 5]],
            [['n' => 'Cheesecake Chocolate', 'q' => 3], ['n' => 'Strawberry Matcha Latte', 'q' => 2]],

            // Taufik Savalas (CUST-0020)
            [['n' => 'Cheesecake Original', 'q' => 1]],

            // Irwan Prayitno (CUST-0021)
            [['n' => 'Broole Thai Tea Topping Oreo', 'q' => 2], ['n' => 'Milk Tea', 'q' => 1]],
            [['n' => 'Cheesecake Oreo', 'q' => 1], ['n' => 'Hazelnut Coffee', 'q' => 1]],

            // Wulan Guritno (CUST-0022)
            [['n' => 'Cheesecake Tiramisu', 'q' => 3], ['n' => 'Sea Salt Butterscotch Coffee', 'q' => 3]],
            [['n' => 'Cheesecake Original', 'q' => 2], ['n' => 'Matcha Latte', 'q' => 2]],

            // Desta Mahendra (CUST-0023)
            [['n' => 'Cheesecake Chocolate', 'q' => 2], ['n' => 'Strawberry Latte', 'q' => 1]],

            // Vincent Rompies (CUST-0024)
            [['n' => 'Broole Original Topping Oreo', 'q' => 2], ['n' => 'Milk Tea', 'q' => 2]],
            [['n' => 'Cheesecake Blueberry', 'q' => 1], ['n' => 'Hazelnut Coffee', 'q' => 1]],

            // Najwa Shihab (CUST-0025)
            [['n' => 'Cheesecake Original', 'q' => 4], ['n' => 'Milk Tea', 'q' => 4]],
            [['n' => 'Cheesecake Tiramisu', 'q' => 2], ['n' => 'Sea Salt Butterscotch Coffee', 'q' => 2]],

            // Raditya Dika (CUST-0026)
            [['n' => 'Broole Chocolate Topping Regal', 'q' => 2], ['n' => 'Sea Salt Butterscotch Chocolate', 'q' => 2]],
            [['n' => 'Cheesecake Oreo', 'q' => 2], ['n' => 'Matcha Latte', 'q' => 1]],

            // Cinta Laura (CUST-0027)
            [['n' => 'Broole Matcha Topping Strawberry', 'q' => 3], ['n' => 'Strawberry Latte', 'q' => 2]],
            [['n' => 'Cheesecake Strawberry', 'q' => 2], ['n' => 'Strawberry Matcha Latte', 'q' => 1]],

            // Raffi Ahmad (CUST-0028)
            [['n' => 'Cheesecake Tiramisu', 'q' => 5], ['n' => 'Cheesecake Oreo', 'q' => 5], ['n' => 'Hazelnut Coffee', 'q' => 5]],
            [['n' => 'Cheesecake Original', 'q' => 4], ['n' => 'Sea Salt Butterscotch Coffee', 'q' => 3]],

            // Nagita Slavina (CUST-0029)
            [['n' => 'Cheesecake Chocolate', 'q' => 6], ['n' => 'Strawberry Latte', 'q' => 6]],
            [['n' => 'Cheesecake Blueberry', 'q' => 3], ['n' => 'Strawberry Matcha Latte', 'q' => 3]],

            // Kaesang Pangarep (CUST-0030)
            [['n' => 'Cheesecake Original', 'q' => 2]],

            // Data Tambahan Graph (Customer 16)
            [['n' => 'Cheesecake Original', 'q' => 1]],
        ];

        // 3. Ambil semua data Order History menggunakan DB
        $orders = DB::table('order_histories')->orderBy('id', 'asc')->get();

        // Array penampung untuk bulk insert (jauh lebih cepat & anti-error)
        $insertData = [];

        // 4. Proses Looping Data
        foreach ($orders as $index => $order) {
            if (isset($blueprints[$index])) {
                foreach ($blueprints[$index] as $item) {
                    
                    $productName = $item['n'];
                    $productId = $products[$productName] ?? null;

                    if ($productId) {
                        $realPrice = $prices[$productId] ?? 0;

                        // BARIS DI BAWAH INI SUDAH BERSIH DARI KOLOM 'product_name'
                        $insertData[] = [
                            'order_id'          => $order->id, 
                            'product_id'        => $productId,
                            'quantity'          => $item['q'],
                            'price_at_purchase' => $realPrice,
                            'created_at'        => now(),
                            'updated_at'        => now()
                        ];
                    }
                }
            }
        }

        // 5. Eksekusi Sekaligus (Bulk Insert) ke database menggunakan DB Builder
        if (!empty($insertData)) {
            DB::table('order_items')->insert($insertData);
        }
    }
}