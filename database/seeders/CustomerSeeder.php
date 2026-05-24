<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan data dasar dan total_spend yang baru
        $customers = [
            ['customer_name' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone' => '081234567890', 'total_spend' => 1450000],
            ['customer_name' => 'Siti Aminah', 'email' => 'siti@example.com', 'phone' => '082198765432', 'total_spend' => 680000],
            ['customer_name' => 'Andi Wijaya', 'email' => 'andi@example.com', 'phone' => '085711223344', 'total_spend' => 150000],
            ['customer_name' => 'Guest User', 'email' => 'guest@example.com', 'phone' => '081234567899', 'total_spend' => 0],
            ['customer_name' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'phone' => '081399887766', 'total_spend' => 3200000],
            ['customer_name' => 'Rian Hidayat', 'email' => 'rian@example.com', 'phone' => '087855667788', 'total_spend' => 890000],
            ['customer_name' => 'Eka Putri', 'email' => 'eka@example.com', 'phone' => '089611223344', 'total_spend' => 320000],
            ['customer_name' => 'Fajar Nugroho', 'email' => 'fajar@example.com', 'phone' => '082233445566', 'total_spend' => 2100000],
            ['customer_name' => 'Siti Rahmawati', 'email' => 'rahma@example.com', 'phone' => '085299881122', 'total_spend' => 1050000],
            ['customer_name' => 'Bambang Pamungkas', 'email' => 'bambang@example.com', 'phone' => '081122334455', 'total_spend' => 250000],
            ['customer_name' => 'Aditya Nugraha', 'email' => 'aditya@example.com', 'phone' => '081255443322', 'total_spend' => 4500000],
            ['customer_name' => 'Maya Indah', 'email' => 'maya@example.com', 'phone' => '085677889900', 'total_spend' => 750000],
            ['customer_name' => 'Rizky Pratama', 'email' => 'rizky@example.com', 'phone' => '081922334455', 'total_spend' => 400000],
            ['customer_name' => 'Diana Lestari', 'email' => 'diana@example.com', 'phone' => '082144556677', 'total_spend' => 1800000],
            ['customer_name' => 'Hendra Wijaya', 'email' => 'hendra@example.com', 'phone' => '087788991122', 'total_spend' => 950000],
            ['customer_name' => 'Riko Simanjuntak', 'email' => 'riko@example.com', 'phone' => '081299445566', 'total_spend' => 1600000],
            ['customer_name' => 'Siti Badriah', 'email' => 'badriah@example.com', 'phone' => '085377881122', 'total_spend' => 550000],
            ['customer_name' => 'Guntur Bumi', 'email' => 'guntur@example.com', 'phone' => '082155661122', 'total_spend' => 820000],
            ['customer_name' => 'Agnes Monica', 'email' => 'agnes@example.com', 'phone' => '081188992233', 'total_spend' => 5100000],
            ['customer_name' => 'Taufik Savalas', 'email' => 'taufik@example.com', 'phone' => '087811229900', 'total_spend' => 200000],
            ['customer_name' => 'Irwan Prayitno', 'email' => 'irwan@example.com', 'phone' => '081344558899', 'total_spend' => 720000],
            ['customer_name' => 'Wulan Guritno', 'email' => 'wulan@example.com', 'phone' => '081266778899', 'total_spend' => 3400000],
            ['customer_name' => 'Desta Mahendra', 'email' => 'desta@example.com', 'phone' => '085622334455', 'total_spend' => 610000],
            ['customer_name' => 'Vincent Rompies', 'email' => 'vincent@example.com', 'phone' => '081955667788', 'total_spend' => 990000],
            ['customer_name' => 'Najwa Shihab', 'email' => 'najwa@example.com', 'phone' => '081122446688', 'total_spend' => 4200000],
            ['customer_name' => 'Raditya Dika', 'email' => 'radika@example.com', 'phone' => '082299887766', 'total_spend' => 1350000],
            ['customer_name' => 'Cinta Laura', 'email' => 'cinta@example.com', 'phone' => '081288776655', 'total_spend' => 2600000],
            ['customer_name' => 'Raffi Ahmad', 'email' => 'raffi@example.com', 'phone' => '081199001122', 'total_spend' => 6500000],
            ['customer_name' => 'Nagita Slavina', 'email' => 'nagita@example.com', 'phone' => '081233445511', 'total_spend' => 5800000],
            ['customer_name' => 'Kaesang Pangarep', 'email' => 'kaesang@example.com', 'phone' => '085744556677', 'total_spend' => 450000],
        ];

        foreach ($customers as $index => $customer) {
            // 1. Set default password untuk semua customer
            $customer['password'] = '12345678';
            
            // 2. Generate Customer ID secara berurutan dan aman (CUST-0001, dst)
            $customer['customer_ID'] = 'CUST-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            
            // 3. Hitung Points Otomatis (Asumsi: 1 poin tiap Rp 1.000)
            $points = floor($customer['total_spend'] / 1000);
            $customer['member_points'] = $points;
            
            // 4. Tentukan Tier Otomatis berdasarkan Points
            if ($points > 1000) {
                $customer['tier'] = 'Gold';
            } elseif ($points > 500) {
                $customer['tier'] = 'Silver';
            } else {
                $customer['tier'] = 'Bronze';
            }

            // 5. Insert ke database
            Customer::create($customer);
        }
    }
}