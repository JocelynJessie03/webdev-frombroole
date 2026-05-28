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
            // Budi Santoso (CUST-0001) - Total: 1,200,000
            [
                'customer_id' => 1,
                'order_date' => now()->subDays(12),
                'total_items' => 5,
                'total_price' => 450000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 1,
                'order_date' => now()->subDays(8),
                'total_items' => 4,
                'total_price' => 350000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 1,
                'order_date' => now()->subDays(3),
                'total_items' => 6,
                'total_price' => 400000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 1,
                'order_date' => now()->subDays(60), 
                'total_items' => 3,
                'total_price' => 350000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 1,
                'order_date' => now(), // Hari Ini
                'total_items' => 2, 
                'total_price' => 150000, 
                'status' => 'Complete',
            ],
            // Siti Aminah (CUST-0002) - Total: 550,000
            [
                'customer_id' => 2,
                'order_date' => now()->subDays(10),
                'total_items' => 3,
                'total_price' => 250000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 2,
                'order_date' => now()->subDays(5),
                'total_items' => 4,
                'total_price' => 300000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 2,
                'order_date' => now()->subDays(90), 
                'total_items' => 5,
                'total_price' => 750000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 2,
                'order_date' => now()->subDays(1), // Kemarin
                'total_items' => 1, 
                'total_price' => 80000, 
                'status' => 'Complete',
            ],
            // Andi Wijaya (CUST-0003) - Total: 80,000
            [
                'customer_id' => 3,
                'order_date' => now()->subDays(2),
                'total_items' => 2,
                'total_price' => 80000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 3,
                'order_date' => now()->subDays(2), // 2 Hari Lalu
                'total_items' => 4, 
                'total_price' => 320000, 
                'status' => 'Complete',
            ],
            // Guest User (CUST-0004) - No orders (0 total_spend)

            
            // Dewi Lestari (CUST-0005) - Total: 2,500,000
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(20),
                'total_items' => 8,
                'total_price' => 1200000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(14),
                'total_items' => 5,
                'total_price' => 800000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(2),
                'total_items' => 3,
                'total_price' => 500000,
                'status' => 'Pending',
            ],
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(120), 
                'total_items' => 2,
                'total_price' => 500000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 5,
                'order_date' => now()->subDays(3), // 3 Hari Lalu
                'total_items' => 3, 
                'total_price' => 210000, 
                'status' => 'Complete',
            ],
            // Rian Hidayat (CUST-0006) - Total: 750,000
            [
                'customer_id' => 6,
                'order_date' => now()->subDays(15),
                'total_items' => 4,
                'total_price' => 450000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 6,
                'order_date' => now()->subDays(7),
                'total_items' => 2,
                'total_price' => 300000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 6,
                'order_date' => now()->subDays(4), // 4 Hari Lalu
                'total_items' => 2, 
                'total_price' => 120000, 
                'status' => 'Complete',
            ],
            // Eka Putri (CUST-0007) - Total: 450,000
            [
                'customer_id' => 7,
                'order_date' => now()->subDays(9),
                'total_items' => 3,
                'total_price' => 250000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 7,
                'order_date' => now()->subHours(5), // Pesanan baru hari ini
                'total_items' => 2,
                'total_price' => 200000,
                'status' => 'Pending',
            ],
            [
                'customer_id' => 7,
                'order_date' => now()->subDays(5), // 5 Hari Lalu
                'total_items' => 5, 
                'total_price' => 450000, 
                'status' => 'Complete',
            ],
            // Fajar Nugroho (CUST-0008) - Total: 1,850,000
            [
                'customer_id' => 8,
                'order_date' => now()->subDays(25),
                'total_items' => 10,
                'total_price' => 1100000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 8,
                'order_date' => now()->subDays(11),
                'total_items' => 6,
                'total_price' => 750000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 8,
                'order_date' => now()->subDays(6), // 6 Hari Lalu
                'total_items' => 1, 
                'total_price' => 950000, 
                'status' => 'Complete',
            ],
            // Siti Rahmawati (CUST-0009) - Total: 980,000
            [
                'customer_id' => 9,
                'order_date' => now()->subDays(18),
                'total_items' => 5,
                'total_price' => 530000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 9,
                'order_date' => now()->subDays(4),
                'total_items' => 4,
                'total_price' => 450000,
                'status' => 'Complete',
            ],
            // Bambang Pamungkas (CUST-0010) - Total: 120,000
            [
                'customer_id' => 10,
                'order_date' => now()->subDays(6),
                'total_items' => 1,
                'total_price' => 120000,
                'status' => 'Complete',
            ],
            // Aditya Nugraha (CUST-0011) - Total: 3,100,000
            [
                'customer_id' => 11,
                'order_date' => now()->subMonths(1)->subDays(5), // Masuk Report Monthly (Bulan Lalu)
                'total_items' => 12,
                'total_price' => 1800000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 11,
                'order_date' => now()->subDays(10), // Masuk Report Weekly (2 minggu lalu)
                'total_items' => 5,
                'total_price' => 900000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 11,
                'order_date' => now()->subHours(2), // Masuk Report Daily (Hari Ini)
                'total_items' => 3,
                'total_price' => 400000,
                'status' => 'Pending',
            ],

            // Maya Indah (CUST-0012) - Total: 620,000
            [
                'customer_id' => 12,
                'order_date' => now()->subDays(16), // Masuk Report Monthly / Weekly lawas
                'total_items' => 4,
                'total_price' => 400000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 12,
                'order_date' => now()->subDays(4), // Masuk Report Weekly (Minggu ini)
                'total_items' => 2,
                'total_price' => 220000,
                'status' => 'Complete',
            ],

            // Rizky Pratama (CUST-0013) - Total: 250,000
            [
                'customer_id' => 13,
                'order_date' => now()->subDays(3), // Masuk Report Weekly
                'total_items' => 2,
                'total_price' => 250000,
                'status' => 'Complete',
            ],

            // Diana Lestari (CUST-0014) - Total: 1,450,000
            [
                'customer_id' => 14,
                'order_date' => now()->subMonths(1), // Masuk Report Monthly
                'total_items' => 7,
                'total_price' => 950000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 14,
                'order_date' => now()->subDays(1), // Masuk Report Daily (Kemarin)
                'total_items' => 3,
                'total_price' => 500000,
                'status' => 'Pending',
            ],

            // Hendra Wijaya (CUST-0015) - Total: 880,000
            [
                'customer_id' => 15,
                'order_date' => now()->subDays(22), // Masuk Report Monthly
                'total_items' => 5,
                'total_price' => 580000,
                'status' => 'Complete',
            ],
            [
                'customer_id' => 15,
                'order_date' => now()->subHours(8), // Masuk Report Daily (Hari Ini)
                'total_items' => 2,
                'total_price' => 300000,
                'status' => 'Complete',
            ],
            // DATA TRANSAKSI UNTUK MEMENUHI 7 HARI TERAKHIR
            [
            'customer_id' => 16,
            'order_date' => now()->subDays(14),
            'total_items' => 4,
            'total_price' => 850000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 16,
            'order_date' => now()->subDays(4),
            'total_items' => 2,
            'total_price' => 500000,
            'status' => 'Complete',
            ],

    // Siti Badriah (CUST-0017) - Total: 480,000
            [
            'customer_id' => 17,
            'order_date' => now()->subDays(11),
            'total_items' => 3,
            'total_price' => 480000,
            'status' => 'Complete',
            ],

    // Guntur Bumi (CUST-0018) - Total: 790,000
            [
            'customer_id' => 18,
            'order_date' => now()->subDays(20),
            'total_items' => 5,
            'total_price' => 450000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 18,
            'order_date' => now()->subDays(6),
            'total_items' => 2,
            'total_price' => 340000,
            'status' => 'Complete',
            ],

    // Agnes Monica (CUST-0019) - Total: 4,200,000
            [
            'customer_id' => 19,
            'order_date' => now()->subMonths(2), // Masuk tren bulanan lawas
            'total_items' => 10,
            'total_price' => 2500000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 19,
            'order_date' => now()->subDays(12),
            'total_items' => 5,
            'total_price' => 1700000,
            'status' => 'Complete',
            ],

            // Taufik Savalas (CUST-0020) - Total: 150,000
            [
            'customer_id' => 20,
            'order_date' => now()->subDays(5),
            'total_items' => 1,
            'total_price' => 150000,
            'status' => 'Complete',
            ],

            // Irwan Prayitno (CUST-0021) - Total: 680,000
            [
            'customer_id' => 21,
            'order_date' => now()->subDays(13),
            'total_items' => 3,
            'total_price' => 380000,
            'status' => 'Complete',
            ],
            [   
            'customer_id' => 21,
            'order_date' => now()->subDays(2),
            'total_items' => 2,
            'total_price' => 300000,
            'status' => 'Complete',
            ],

            // Wulan Guritno (CUST-0022) - Total: 2,850,000
            [
            'customer_id' => 22,
            'order_date' => now()->subMonths(1)->subDays(2),
            'total_items' => 6,
            'total_price' => 1500000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 22,
            'order_date' => now()->subDays(7),
            'total_items' => 4,
            'total_price' => 1350000,
            'status' => 'Complete',
            ],

            // Desta Mahendra (CUST-0023) - Total: 520,000
            [
            'customer_id' => 23,
            'order_date' => now()->subDays(8),
            'total_items' => 3,
            'total_price' => 520000,
            'status' => 'Complete',
            ],

            // Vincent Rompies (CUST-0024) - Total: 910,000
            [
            'customer_id' => 24,
            'order_date' => now()->subDays(15),
            'total_items' => 4,
            'total_price' => 510000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 24,
            'order_date' => now()->subDays(1), // Kemarin
            'total_items' => 2,
            'total_price' => 400000,
            'status' => 'Complete',
            ],

            // Najwa Shihab (CUST-0025) - Total: 3,500,000
            [
            'customer_id' => 25,
            'order_date' => now()->subMonths(1)->subDays(10),
            'total_items' => 8,
            'total_price' => 2000000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 25,
            'order_date' => now()->subDays(3),
            'total_items' => 4,
            'total_price' => 1500000,
            'status' => 'Complete',
            ],

            // Raditya Dika (CUST-0026) - Total: 1,150,000
            [
            'customer_id' => 26,
            'order_date' => now()->subDays(9),
            'total_items' => 4,
            'total_price' => 650000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 26,
            'order_date' => now()->subHours(12), // Hari Ini
            'total_items' => 3,
            'total_price' => 500000,
            'status' => 'Complete',
            ],

            // Cinta Laura (CUST-0027) - Total: 2,100,000
            [
            'customer_id' => 27,
            'order_date' => now()->subDays(16),
            'total_items' => 5,
            'total_price' => 1200000,
            'status' => 'Complete',
            ],  
            [
            'customer_id' => 27,
            'order_date' => now()->subDays(6),
            'total_items' => 3,
            'total_price' => 900000,
            'status' => 'Complete',
            ],

            // Raffi Ahmad (CUST-0028) - Total: 5,000,000
            [
            'customer_id' => 28,
            'order_date' => now()->subMonths(2),
            'total_items' => 15,
            'total_price' => 3000000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 28,
            'order_date' => now()->subDays(10),
            'total_items' => 7,
            'total_price' => 2000000,
            'status' => 'Complete',
            ],

            // Nagita Slavina (CUST-0029) - Total: 4,800,000
            [
            'customer_id' => 29,
            'order_date' => now()->subMonths(1),
            'total_items' => 12,
            'total_price' => 2800000,
            'status' => 'Complete',
            ],
            [
            'customer_id' => 29,
            'order_date' => now()->subDays(4),
            'total_items' => 6,
            'total_price' => 2000000,
            'status' => 'Complete',
            ],

            // Kaesang Pangarep (CUST-0030) - Total: 350,000
            [
            'customer_id' => 30,
            'order_date' => now()->subDays(2),
            'total_items' => 2,
            'total_price' => 350000,
            'status' => 'Complete',
            ],
            // DATA TAMBAHAN UNTUK MEMENUHI RENTANG 7 HARI TERAKHIR (DAILY GRAPH)
            [
            'customer_id' => 16,
            'order_date' => now()->subDays(7),
            'total_items' => 1,
            'total_price' => 100000,
            'status' => 'Pending', // Tidak mempengaruhi total_spend, tapi muncul di grafik daily jika status pending diikutkan
            ],
        ];

        foreach ($ordersData as $index => $order) {
            $order['order_id'] = 'INV-' . $order['order_date']->format('Ymd') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            OrderHistory::create($order);
        }
    }
}
