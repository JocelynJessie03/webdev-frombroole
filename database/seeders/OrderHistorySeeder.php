<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderHistory;

class OrderHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ordersData = [
            // Budi Santoso (CUST-0001)
            [
                'customer_id' => 1,
                'order_date' => now()->subDays(12),
                'total_items' => 5,
                'total_price' => 194000, // 2x Cheesecake Tiramisu (40k) + 3x Cheesecake Oreo (38k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 1,
                'order_date' => now()->subDays(8),
                'total_items' => 4,
                'total_price' => 90000, // 2x Broole Original Oreo (25k) + 2x Strawberry Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 1,
                'order_date' => now()->subDays(3),
                'total_items' => 6,
                'total_price' => 126000, // 3x Broole Chocolate Regal (27k) + 3x Milk Tea (15k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 1,
                'order_date' => now()->subDays(60), 
                'total_items' => 3,
                'total_price' => 79000, // 1x Cheesecake Original (35k) + 2x Sea Salt Coffee (22k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 1,
                'order_date' => now(), 
                'total_items' => 2, 
                'total_price' => 58000, // 1x Cheesecake Blueberry (38k) + 1x Hazelnut Coffee (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Siti Aminah (CUST-0002)
            [
                'customer_id' => 2,
                'order_date' => now()->subDays(10),
                'total_items' => 3,
                'total_price' => 78000, // 1x Cheesecake Matcha (38k) + 2x Matcha Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 2,
                'order_date' => now()->subDays(5),
                'total_items' => 4,
                'total_price' => 100000, // 2x Broole Matcha Oreo (28k) + 2x Sea Salt Matcha (22k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 2,
                'order_date' => now()->subDays(90), 
                'total_items' => 5,
                'total_price' => 160000, // 3x Cheesecake Tiramisu (40k) + 2x Hazelnut Coffee (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 2,
                'order_date' => now()->subDays(1), 
                'total_items' => 1, 
                'total_price' => 35000, // 1x Cheesecake Original (35k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Andi Wijaya (CUST-0003)
            [
                'customer_id' => 3,
                'order_date' => now()->subDays(2),
                'total_items' => 2,
                'total_price' => 40000, // 2x Matcha Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 3,
                'order_date' => now()->subDays(2), 
                'total_items' => 4, 
                'total_price' => 106000, // 2x Cheesecake Oreo (38k) + 2x Milk Tea (15k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Guest User (CUST-0004) - No orders

            // Dewi Lestari (CUST-0005)
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(20),
                'total_items' => 8,
                'total_price' => 244000, // 4x Cheesecake Chocolate (38k) + 4x Strawberry Matcha Latte (23k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(14),
                'total_items' => 5,
                'total_price' => 128000, // 3x Broole Tiramisu Regal (28k) + 2x Sea Salt Butterscotch Choc (22k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(2),
                'total_items' => 3,
                'total_price' => 96000, // 2x Cheesecake Strawberry (38k) + 1x Strawberry Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(120), 
                'total_items' => 2,
                'total_price' => 80000, // 2x Cheesecake Tiramisu (40k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(3), 
                'total_items' => 3, 
                'total_price' => 56000, // 1x Broole Thai Tea Oreo (26k) + 2x Milk Tea (15k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Rian Hidayat (CUST-0006)
            [
                'customer_id' => 6,
                'order_date' => now()->subDays(15),
                'total_items' => 4,
                'total_price' => 126000, // 2x Cheesecake Oreo (38k) + 2x Broole Original Oreo (25k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 6,
                'order_date' => now()->subDays(7),
                'total_items' => 2,
                'total_price' => 76000, // 2x Cheesecake Chocolate (38k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 6,
                'order_date' => now()->subDays(4), 
                'total_items' => 2, 
                'total_price' => 48000, // 1x Broole Matcha Regal (28k) + 1x Strawberry Latte (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Eka Putri (CUST-0007)
            [
                'customer_id' => 7,
                'order_date' => now()->subDays(9),
                'total_items' => 3,
                'total_price' => 65000, // 1x Cheesecake Original (35k) + 2x Milk Tea (15k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 7,
                'order_date' => now()->subHours(5), 
                'total_items' => 2,
                'total_price' => 56000, // 2x Broole Tiramisu Oreo (28k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 7,
                'order_date' => now()->subDays(5), 
                'total_items' => 5, 
                'total_price' => 136000, // 2x Cheesecake Strawberry (38k) + 3x Strawberry Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Fajar Nugroho (CUST-0008)
            [
                'customer_id' => 8,
                'order_date' => now()->subDays(25),
                'total_items' => 10,
                'total_price' => 275000, // 5x Cheesecake Original (35k) + 5x Hazelnut Coffee (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 8,
                'order_date' => now()->subDays(11),
                'total_items' => 6,
                'total_price' => 147000, // 3x Broole Chocolate Oreo (27k) + 3x Sea Salt Chocolate (22k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 8,
                'order_date' => now()->subDays(6), 
                'total_items' => 1, 
                'total_price' => 40000, // 1x Cheesecake Tiramisu (40k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Siti Rahmawati (CUST-0009)
            [
                'customer_id' => 9,
                'order_date' => now()->subDays(18),
                'total_items' => 5,
                'total_price' => 121000, // 2x Cheesecake Blueberry (38k) + 3x Milk Tea (15k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 9,
                'order_date' => now()->subDays(4),
                'total_items' => 4,
                'total_price' => 96000, // 2x Broole Thai Tea Regal (26k) + 2x Sea Salt Coffee (22k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Bambang Pamungkas (CUST-0010)
            [
                'customer_id' => 10,
                'order_date' => now()->subDays(6),
                'total_items' => 1,
                'total_price' => 40000, // 1x Cheesecake Tiramisu (40k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Aditya Nugraha (CUST-0011)
            [
                'customer_id' => 11,
                'order_date' => now()->subMonths(1)->subDays(5), 
                'total_items' => 12,
                'total_price' => 348000, // 6x Cheesecake Oreo (38k) + 6x Matcha Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 11,
                'order_date' => now()->subDays(10), 
                'total_items' => 5,
                'total_price' => 115000, // 3x Broole Original Strawberry (25k) + 2x Strawberry Latte (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 11,
                'order_date' => now()->subHours(2), 
                'total_items' => 3,
                'total_price' => 98000, // 2x Cheesecake Chocolate (38k) + 1x Sea Salt Chocolate (22k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Maya Indah (CUST-0012)
            [
                'customer_id' => 12,
                'order_date' => now()->subDays(16), 
                'total_items' => 4,
                'total_price' => 110000, // 2x Cheesecake Original (35k) + 2x Hazelnut Coffee (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 12,
                'order_date' => now()->subDays(4), 
                'total_items' => 2,
                'total_price' => 51000, // 1x Broole Matcha Oreo (28k) + 1x Strawberry Matcha Latte (23k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Rizky Pratama (CUST-0013)
            [
                'customer_id' => 13,
                'order_date' => now()->subDays(3), 
                'total_items' => 2,
                'total_price' => 70000, // 2x Cheesecake Original (35k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Diana Lestari (CUST-0014)
            [
                'customer_id' => 14,
                'order_date' => now()->subMonths(1), 
                'total_items' => 7,
                'total_price' => 212000, // 4x Cheesecake Chocolate (38k) + 3x Hazelnut Coffee (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 14,
                'order_date' => now()->subDays(1), 
                'total_items' => 3,
                'total_price' => 65000, // 2x Broole Original Regal (25k) + 1x Milk Tea (15k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Hendra Wijaya (CUST-0015)
            [
                'customer_id' => 15,
                'order_date' => now()->subDays(22), 
                'total_items' => 5,
                'total_price' => 121000, // 2x Cheesecake Oreo (38k) + 3x Milk Tea (15k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 15,
                'order_date' => now()->subHours(8), 
                'total_items' => 2,
                'total_price' => 62000, // 1x Cheesecake Tiramisu (40k) + 1x Sea Salt Coffee (22k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Customer 16
            [
                'customer_id' => 16,
                'order_date' => now()->subDays(14),
                'total_items' => 4,
                'total_price' => 110000, // 2x Cheesecake Original (35k) + 2x Matcha Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 16,
                'order_date' => now()->subDays(4),
                'total_items' => 2,
                'total_price' => 42000, // 1x Broole Chocolate Oreo (27k) + 1x Milk Tea (15k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Siti Badriah (CUST-0017)
            [
                'customer_id' => 17,
                'order_date' => now()->subDays(11),
                'total_items' => 3,
                'total_price' => 91000, // 2x Cheesecake Oreo (38k) + 1x Milk Tea (15k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Guntur Bumi (CUST-0018)
            [
                'customer_id' => 18,
                'order_date' => now()->subDays(20),
                'total_items' => 5,
                'total_price' => 115000, // 3x Broole Original Oreo (25k) + 2x Strawberry Latte (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 18,
                'order_date' => now()->subDays(6),
                'total_items' => 2,
                'total_price' => 60000, // 1x Cheesecake Tiramisu (40k) + 1x Hazelnut Coffee (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Agnes Monica (CUST-0019)
            [
                'customer_id' => 19,
                'order_date' => now()->subMonths(2), 
                'total_items' => 10,
                'total_price' => 300000, // 5x Cheesecake Tiramisu (40k) + 5x Matcha Latte (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 19,
                'order_date' => now()->subDays(12),
                'total_items' => 5,
                'total_price' => 160000, // 3x Cheesecake Chocolate (38k) + 2x Strawberry Matcha Latte (23k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Taufik Savalas (CUST-0020)
            [
                'customer_id' => 20,
                'order_date' => now()->subDays(5),
                'total_items' => 1,
                'total_price' => 35000, // 1x Cheesecake Original (35k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Irwan Prayitno (CUST-0021)
            [
                'customer_id' => 21,
                'order_date' => now()->subDays(13),
                'total_items' => 3,
                'total_price' => 67000, // 2x Broole Thai Tea Oreo (26k) + 1x Milk Tea (15k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [   
                'customer_id' => 21,
                'order_date' => now()->subDays(2),
                'total_items' => 2,
                'total_price' => 58000, // 1x Cheesecake Oreo (38k) + 1x Hazelnut Coffee (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Wulan Guritno (CUST-0022)
            [
                'customer_id' => 22,
                'order_date' => now()->subMonths(1)->subDays(2),
                'total_items' => 6,
                'total_price' => 186000, // 3x Cheesecake Tiramisu (40k) + 3x Sea Salt Coffee (22k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 22,
                'order_date' => now()->subDays(7),
                'total_items' => 4,
                'total_price' => 110000, // 2x Cheesecake Original (35k) + 2x Matcha Latte (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],

            // Desta Mahendra (CUST-0023)
            [
                'customer_id' => 23,
                'order_date' => now()->subDays(8),
                'total_items' => 3,
                'total_price' => 96000, // 2x Cheesecake Chocolate (38k) + 1x Strawberry Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Vincent Rompies (CUST-0024)
            [
                'customer_id' => 24,
                'order_date' => now()->subDays(15),
                'total_items' => 4,
                'total_price' => 80000, // 2x Broole Original Oreo (25k) + 2x Milk Tea (15k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 24,
                'order_date' => now()->subDays(1), 
                'total_items' => 2,
                'total_price' => 58000, // 1x Cheesecake Blueberry (38k) + 1x Hazelnut Coffee (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Najwa Shihab (CUST-0025)
            [
                'customer_id' => 25,
                'order_date' => now()->subMonths(1)->subDays(10),
                'total_items' => 8,
                'total_price' => 200000, // 4x Cheesecake Original (35k) + 4x Milk Tea (15k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 25,
                'order_date' => now()->subDays(3),
                'total_items' => 4,
                'total_price' => 124000, // 2x Cheesecake Tiramisu (40k) + 2x Sea Salt Coffee (22k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Raditya Dika (CUST-0026)
            [
                'customer_id' => 26,
                'order_date' => now()->subDays(9),
                'total_items' => 4,
                'total_price' => 98000, // 2x Broole Chocolate Regal (27k) + 2x Sea Salt Chocolate (22k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 26,
                'order_date' => now()->subHours(12), 
                'total_items' => 3,
                'total_price' => 96000, // 2x Cheesecake Oreo (38k) + 1x Matcha Latte (20k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Cinta Laura (CUST-0027)
            [
                'customer_id' => 27,
                'order_date' => now()->subDays(16),
                'total_items' => 5,
                'total_price' => 124000, // 3x Broole Matcha Strawberry (28k) + 2x Strawberry Latte (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],  
            [
                'customer_id' => 27,
                'order_date' => now()->subDays(6),
                'total_items' => 3,
                'total_price' => 99000, // 2x Cheesecake Strawberry (38k) + 1x Strawberry Matcha Latte (23k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Raffi Ahmad (CUST-0028)
            [
                'customer_id' => 28,
                'order_date' => now()->subMonths(2),
                'total_items' => 15,
                'total_price' => 490000, // 5x Cheesecake Tiramisu (40k) + 5x Cheesecake Oreo (38k) + 5x Hazelnut Coffee (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 28,
                'order_date' => now()->subDays(10),
                'total_items' => 7,
                'total_price' => 206000, // 4x Cheesecake Original (35k) + 3x Sea Salt Coffee (22k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Nagita Slavina (CUST-0029)
            [
                'customer_id' => 29,
                'order_date' => now()->subMonths(1),
                'total_items' => 12,
                'total_price' => 348000, // 6x Cheesecake Chocolate (38k) + 6x Strawberry Latte (20k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            [
                'customer_id' => 29,
                'order_date' => now()->subDays(4),
                'total_items' => 6,
                'total_price' => 183000, // 3x Cheesecake Blueberry (38k) + 3x Strawberry Matcha Latte (23k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete',
            ],

            // Kaesang Pangarep (CUST-0030)
            [
                'customer_id' => 30,
                'order_date' => now()->subDays(2),
                'total_items' => 2,
                'total_price' => 70000, // 2x Cheesecake Original (35k)
                'payment_method' => 'Cash',
                'status' => 'Complete',
            ],
            
            // DATA TAMBAHAN UNTUK DAILY GRAPH (Customer 16)
            [
                'customer_id' => 16,
                'order_date' => now()->subDays(7),
                'total_items' => 1,
                'total_price' => 35000, // 1x Cheesecake Original (35k)
                'payment_method' => 'Qris/Gopay',
                'status' => 'Complete', 
            ],
        ];

        foreach ($ordersData as $index => $order) {
            $order['order_id'] = 'INV-' . $order['order_date']->format('Ymd') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            OrderHistory::create($order);
        }
    }
}