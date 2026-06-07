<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\OrderHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ordersData = [
            // Budi Santoso (CUST-0001)
            ['customer_id' => 1, 'order_date' => now()->subDays(12), 'total_items' => 5, 'total_price' => 194000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 1, 'order_date' => now()->subDays(8), 'total_items' => 4, 'total_price' => 90000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 1, 'order_date' => now()->subDays(3), 'total_items' => 6, 'total_price' => 126000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 1, 'order_date' => now()->subDays(60), 'total_items' => 3, 'total_price' => 79000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 1, 'order_date' => now(), 'total_items' => 2, 'total_price' => 58000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Siti Aminah (CUST-0002)
            ['customer_id' => 2, 'order_date' => now()->subDays(10), 'total_items' => 3, 'total_price' => 78000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 2, 'order_date' => now()->subDays(5), 'total_items' => 4, 'total_price' => 100000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 2, 'order_date' => now()->subDays(90), 'total_items' => 5, 'total_price' => 160000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 2, 'order_date' => now()->subDays(1), 'total_items' => 1, 'total_price' => 35000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Andi Wijaya (CUST-0003)
            ['customer_id' => 3, 'order_date' => now()->subDays(2), 'total_items' => 2, 'total_price' => 40000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 3, 'order_date' => now()->subDays(2), 'total_items' => 4, 'total_price' => 106000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Dewi Lestari (CUST-0005)
            ['customer_id' => 5, 'order_date' => now()->subDays(20), 'total_items' => 8, 'total_price' => 244000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 5, 'order_date' => now()->subDays(14), 'total_items' => 5, 'total_price' => 128000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 5, 'order_date' => now()->subDays(2), 'total_items' => 3, 'total_price' => 96000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 5, 'order_date' => now()->subDays(120), 'total_items' => 2, 'total_price' => 80000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 5, 'order_date' => now()->subDays(3), 'total_items' => 3, 'total_price' => 56000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Rian Hidayat (CUST-0006)
            ['customer_id' => 6, 'order_date' => now()->subDays(15), 'total_items' => 4, 'total_price' => 126000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 6, 'order_date' => now()->subDays(7), 'total_items' => 2, 'total_price' => 76000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 6, 'order_date' => now()->subDays(4), 'total_items' => 2, 'total_price' => 48000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Eka Putri (CUST-0007)
            ['customer_id' => 7, 'order_date' => now()->subDays(9), 'total_items' => 3, 'total_price' => 65000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 7, 'order_date' => now()->subHours(5), 'total_items' => 2, 'total_price' => 56000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 7, 'order_date' => now()->subDays(5), 'total_items' => 5, 'total_price' => 136000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Fajar Nugroho (CUST-0008)
            ['customer_id' => 8, 'order_date' => now()->subDays(25), 'total_items' => 10, 'total_price' => 275000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 8, 'order_date' => now()->subDays(11), 'total_items' => 6, 'total_price' => 147000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 8, 'order_date' => now()->subDays(6), 'total_items' => 1, 'total_price' => 40000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Siti Rahmawati (CUST-0009)
            ['customer_id' => 9, 'order_date' => now()->subDays(18), 'total_items' => 5, 'total_price' => 121000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 9, 'order_date' => now()->subDays(4), 'total_items' => 4, 'total_price' => 96000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Bambang Pamungkas (CUST-0010)
            ['customer_id' => 10, 'order_date' => now()->subDays(6), 'total_items' => 1, 'total_price' => 40000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Aditya Nugraha (CUST-0011)
            ['customer_id' => 11, 'order_date' => now()->subMonths(1)->subDays(5), 'total_items' => 12, 'total_price' => 348000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 11, 'order_date' => now()->subDays(10), 'total_items' => 5, 'total_price' => 115000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 11, 'order_date' => now()->subHours(2), 'total_items' => 3, 'total_price' => 98000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Maya Indah (CUST-0012)
            ['customer_id' => 12, 'order_date' => now()->subDays(16), 'total_items' => 4, 'total_price' => 110000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 12, 'order_date' => now()->subDays(4), 'total_items' => 2, 'total_price' => 51000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Rizky Pratama (CUST-0013)
            ['customer_id' => 13, 'order_date' => now()->subDays(3), 'total_items' => 2, 'total_price' => 70000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Diana Lestari (CUST-0014)
            ['customer_id' => 14, 'order_date' => now()->subMonths(1), 'total_items' => 7, 'total_price' => 212000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 14, 'order_date' => now()->subDays(1), 'total_items' => 3, 'total_price' => 65000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Hendra Wijaya (CUST-0015)
            ['customer_id' => 15, 'order_date' => now()->subDays(22), 'total_items' => 5, 'total_price' => 121000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 15, 'order_date' => now()->subHours(8), 'total_items' => 2, 'total_price' => 62000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Customer 16
            ['customer_id' => 16, 'order_date' => now()->subDays(14), 'total_items' => 4, 'total_price' => 110000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 16, 'order_date' => now()->subDays(4), 'total_items' => 2, 'total_price' => 42000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 16, 'order_date' => now()->subDays(7), 'total_items' => 1, 'total_price' => 35000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Siti Badriah (CUST-0017)
            ['customer_id' => 17, 'order_date' => now()->subDays(11), 'total_items' => 3, 'total_price' => 91000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Guntur Bumi (CUST-0018)
            ['customer_id' => 18, 'order_date' => now()->subDays(20), 'total_items' => 5, 'total_price' => 115000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 18, 'order_date' => now()->subDays(6), 'total_items' => 2, 'total_price' => 60000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Agnes Monica (CUST-0019)
            ['customer_id' => 19, 'order_date' => now()->subMonths(2), 'total_items' => 10, 'total_price' => 300000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 19, 'order_date' => now()->subDays(12), 'total_items' => 5, 'total_price' => 160000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Taufik Savalas (CUST-0020)
            ['customer_id' => 20, 'order_date' => now()->subDays(5), 'total_items' => 1, 'total_price' => 35000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Irwan Prayitno (CUST-0021)
            ['customer_id' => 21, 'order_date' => now()->subDays(13), 'total_items' => 3, 'total_price' => 67000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 21, 'order_date' => now()->subDays(2), 'total_items' => 2, 'total_price' => 58000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Wulan Guritno (CUST-0022)
            ['customer_id' => 22, 'order_date' => now()->subMonths(1)->subDays(2), 'total_items' => 6, 'total_price' => 186000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],
            ['customer_id' => 22, 'order_date' => now()->subDays(7), 'total_items' => 4, 'total_price' => 110000, 'payment_method' => 'Cash', 'status' => 'Complete'],

            // Desta Mahendra (CUST-0023)
            ['customer_id' => 23, 'order_date' => now()->subDays(8), 'total_items' => 3, 'total_price' => 96000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Vincent Rompies (CUST-0024)
            ['customer_id' => 24, 'order_date' => now()->subDays(15), 'total_items' => 4, 'total_price' => 80000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 24, 'order_date' => now()->subDays(1), 'total_items' => 2, 'total_price' => 58000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Najwa Shihab (CUST-0025)
            ['customer_id' => 25, 'order_date' => now()->subMonths(1)->subDays(10), 'total_items' => 8, 'total_price' => 200000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 25, 'order_date' => now()->subDays(3), 'total_items' => 4, 'total_price' => 124000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Raditya Dika (CUST-0026)
            ['customer_id' => 26, 'order_date' => now()->subDays(9), 'total_items' => 4, 'total_price' => 98000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 26, 'order_date' => now()->subHours(12), 'total_items' => 3, 'total_price' => 96000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Cinta Laura (CUST-0027)
            ['customer_id' => 27, 'order_date' => now()->subDays(16), 'total_items' => 5, 'total_price' => 124000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 27, 'order_date' => now()->subDays(6), 'total_items' => 3, 'total_price' => 99000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Raffi Ahmad (CUST-0028)
            ['customer_id' => 28, 'order_date' => now()->subMonths(2), 'total_items' => 15, 'total_price' => 490000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 28, 'order_date' => now()->subDays(10), 'total_items' => 7, 'total_price' => 206000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Nagita Slavina (CUST-0029)
            ['customer_id' => 29, 'order_date' => now()->subMonths(1), 'total_items' => 12, 'total_price' => 348000, 'payment_method' => 'Cash', 'status' => 'Complete'],
            ['customer_id' => 29, 'order_date' => now()->subDays(4), 'total_items' => 6, 'total_price' => 183000, 'payment_method' => 'Qris/Gopay', 'status' => 'Complete'],

            // Kaesang Pangarep (CUST-0030)
            ['customer_id' => 30, 'order_date' => now()->subDays(2), 'total_items' => 2, 'total_price' => 70000, 'payment_method' => 'Cash', 'status' => 'Complete'],
        ];

        // LOGIKA BARU: Urutkan data berdasarkan 'order_date' secara Ascending (Lama ke Baru)
        usort($ordersData, function ($a, $b) {
            return $a['order_date'] <=> $b['order_date'];
        });

        // 1. Insert riwayat order yang SUDAH BERURUTAN TANGGALNYA ke database
        foreach ($ordersData as $index => $order) {
            // ID Order terbuat runtut secara kronologis (ORD-00001, ORD-00002, dst.)
            $banyakOrder= DB::table('order_histories')->count();
            $orderId = 'INV-' . now()->format('YmdHis') . '-' . str_pad($banyakOrder + 1, 3, '0', STR_PAD_LEFT);
            OrderHistory::create([
                'order_id'       => $orderId,
                'customer_id'    => $order['customer_id'],
                'order_date'     => $order['order_date'],
                'total_items'    => $order['total_items'],
                'total_price'    => $order['total_price'],
                'payment_method' => $order['payment_method'],
                'status'         => $order['status'],
                'payment_status' => 'PAID', // Tambahkan payment_status PAID
            ]);
        }

        // 2. OTOMATISASI DAN SINKRONISASI KE TABEL CUSTOMER
        $allCustomers = Customer::all();

        foreach ($allCustomers as $customer) {
            // Hitung total belanja riil dari data yang baru saja dimasukkan
            $actualSpend = DB::table('order_histories')->where('customer_id', $customer->id)->sum('total_price');
            
            // 1 Poin tiap kelipatan Rp 100 belanja
            $calculatedPoints = floor($actualSpend / 100);

            // 1. Hitung Persentase Progress Bar (Maksimal Rp 700.000 untuk 100% Full)
            $progressPercentage = min(($actualSpend / 700000) * 100, 100);

            // 2. Menentukan Tier Sesuai Keinginanmu (Batas Baru)
            if ($actualSpend >= 500000) {
                // Gold: >= Rp 700.000 (Mulai dari 7.000 Poin) -> Bar: 100% Full
                $tier = 'Gold';
            } elseif ($actualSpend >= 300000) {
                // Silver: Rp 300.000 - Rp 699.999 (3.000 - 6.999 Poin) -> Bar: 43% - 99%
                $tier = 'Silver';
            } else {
                // Bronze: Rp 0 - Rp 299.999 (0 - 2.999 Poin) -> Bar: 0% - 42%
                $tier = 'Bronze';
            }

            // Update data ke database
            $customer->update([
                'total_spend'         => $actualSpend,
                'member_points'       => $calculatedPoints,
                'tier'                => $tier,
                'progress_percentage' => round($progressPercentage),
            ]);
        }
    }
}