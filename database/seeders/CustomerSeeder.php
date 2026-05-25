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
        $customers = [
            ['customer_name' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone' => '081234567890'],
            ['customer_name' => 'Siti Aminah', 'email' => 'siti@example.com', 'phone' => '082198765432'],
            ['customer_name' => 'Andi Wijaya', 'email' => 'andi@example.com', 'phone' => '085711223344'],
            ['customer_name' => 'Guest User', 'email' => 'guest@example.com', 'phone' => '081234567899'],
            ['customer_name' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'phone' => '081399887766'],
            ['customer_name' => 'Rian Hidayat', 'email' => 'rian@example.com', 'phone' => '087855667788'],
            ['customer_name' => 'Eka Putri', 'email' => 'eka@example.com', 'phone' => '089611223344'],
            ['customer_name' => 'Fajar Nugroho', 'email' => 'fajar@example.com', 'phone' => '082233445566'],
            ['customer_name' => 'Siti Rahmawati', 'email' => 'rahma@example.com', 'phone' => '085299881122'],
            ['customer_name' => 'Bambang Pamungkas', 'email' => 'bambang@example.com', 'phone' => '081122334455'],
            ['customer_name' => 'Aditya Nugraha', 'email' => 'aditya@example.com', 'phone' => '081255443322'],
            ['customer_name' => 'Maya Indah', 'email' => 'maya@example.com', 'phone' => '085677889900'],
            ['customer_name' => 'Rizky Pratama', 'email' => 'rizky@example.com', 'phone' => '081922334455'],
            ['customer_name' => 'Diana Lestari', 'email' => 'diana@example.com', 'phone' => '082144556677'],
            ['customer_name' => 'Hendra Wijaya', 'email' => 'hendra@example.com', 'phone' => '087788991122'],
            ['customer_name' => 'Riko Simanjuntak', 'email' => 'riko@example.com', 'phone' => '081299445566'], // ID: 16
            ['customer_name' => 'Siti Badriah', 'email' => 'badriah@example.com', 'phone' => '085377881122'],
            ['customer_name' => 'Guntur Bumi', 'email' => 'guntur@example.com', 'phone' => '082155661122'],
            ['customer_name' => 'Agnes Monica', 'email' => 'agnes@example.com', 'phone' => '081188992233'],
            ['customer_name' => 'Taufik Savalas', 'email' => 'taufik@example.com', 'phone' => '087811229900'],
            ['customer_name' => 'Irwan Prayitno', 'email' => 'irwan@example.com', 'phone' => '081344558899'],
            ['customer_name' => 'Wulan Guritno', 'email' => 'wulan@example.com', 'phone' => '081266778899'],
            ['customer_name' => 'Desta Mahendra', 'email' => 'desta@example.com', 'phone' => '085622334455'],
            ['customer_name' => 'Vincent Rompies', 'email' => 'vincent@example.com', 'phone' => '081955667788'],
            ['customer_name' => 'Najwa Shihab', 'email' => 'najwa@example.com', 'phone' => '081122446688'],
            ['customer_name' => 'Raditya Dika', 'email' => 'radika@example.com', 'phone' => '082299887766'],
            ['customer_name' => 'Cinta Laura', 'email' => 'cinta@example.com', 'phone' => '081288776655'],
            ['customer_name' => 'Raffi Ahmad', 'email' => 'raffi@example.com', 'phone' => '081199001122'],
            ['customer_name' => 'Nagita Slavina', 'email' => 'nagita@example.com', 'phone' => '081233445511'],
            ['customer_name' => 'Kaesang Pangarep', 'email' => 'kaesang@example.com', 'phone' => '085744556677'],
        ];

        foreach ($customers as $index => $customer) {
            $customer['password'] = '12345678';
            $customer['customer_ID'] = 'CUST-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            
            // Set default awal ke 0, nanti dihitung otomatis dari transaksi
            $customer['total_spend'] = 0;
            $customer['member_points'] = 0;
            $customer['tier'] = 'Bronze';

            Customer::create($customer);
        }
    }
}