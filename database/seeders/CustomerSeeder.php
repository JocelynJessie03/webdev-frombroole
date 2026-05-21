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
            [
                'customer_ID' => 'CUST-0001',
                'customer_name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => '12345678', // Password sederhana untuk contoh
                'phone' => '081234567890',
                'total_spend' => 1200000,
                'member_points' => 1200,
                'tier' => 'Gold', // Poin > 1000
            ],
            [
                'customer_ID' => 'CUST-0002',
                'customer_name' => 'Siti Aminah',
                'email' => 'siti@example.com',
                'password' => '12345678',
                'phone' => '082198765432',
                'total_spend' => 550000,
                'member_points' => 550,
                'tier' => 'Silver', // Poin > 500
            ],
            [
                'customer_ID' => 'CUST-0003',
                'customer_name' => 'Andi Wijaya',
                'email' => 'andi@example.com',
                'password' => '12345678',
                'phone' => '085711223344',
                'total_spend' => 80000,
                'member_points' => 80,
                'tier' => 'Bronze', // Poin baru sedikit
            ],
            [
                'customer_ID' => 'CUST-0004',
                'customer_name' => 'Guest User',
                'email' => 'guest@example.com',
                'password' => '12345678',
                'phone' => '081234567899',
                'total_spend' => 0,
                'member_points' => 0,
                'tier' => 'Bronze',
            ],
            [
                'customer_ID' => 'CUST-0005',
                'customer_name' => 'Dewi Lestari',
                'email' => 'dewi@example.com',
                'password' => '12345678',
                'phone' => '081399887766',
                'total_spend' => 2500000,
                'member_points' => 2500,
                'tier' => 'Gold', // Poin > 1000
            ],
            [
                'customer_ID' => 'CUST-0006',
                'customer_name' => 'Rian Hidayat',
                'email' => 'rian@example.com',
                'password' => '12345678',
                'phone' => '087855667788',
                'total_spend' => 750000,
                'member_points' => 750,
                'tier' => 'Silver', // Poin > 500
            ],
            [
                'customer_ID' => 'CUST-0007',
                'customer_name' => 'Eka Putri',
                'email' => 'eka@example.com',
                'password' => '12345678',
                'phone' => '089611223344',
                'total_spend' => 450000,
                'member_points' => 450,
                'tier' => 'Bronze', // Poin < 500
            ],
            [
                'customer_ID' => 'CUST-0008',
                'customer_name' => 'Fajar Nugroho',
                'email' => 'fajar@example.com',
                'password' => '12345678',
                'phone' => '082233445566',
                'total_spend' => 1850000,
                'member_points' => 1850,
                'tier' => 'Gold', // Poin > 1000
            ],
            [
                'customer_ID' => 'CUST-0009',
                'customer_name' => 'Siti Rahmawati',
                'email' => 'rahma@example.com',
                'password' => '12345678',
                'phone' => '085299881122',
                'total_spend' => 980000,
                'member_points' => 980,
                'tier' => 'Silver', // Poin > 500
            ],
            [
                'customer_ID' => 'CUST-0010',
                'customer_name' => 'Bambang Pamungkas',
                'email' => 'bambang@example.com',
                'password' => '12345678',
                'phone' => '081122334455',
                'total_spend' => 120000,
                'member_points' => 120,
                'tier' => 'Bronze', // Poin < 500
            ],
            [
                'customer_ID' => 'CUST-0011',
                'customer_name' => 'Aditya Nugraha',
                'email' => 'aditya@example.com',
                'password' => '12345678',
                'phone' => '081255443322',
                'total_spend' => 3100000,
                'member_points' => 3100,
                'tier' => 'Gold', // Poin > 1000
            ],
            [
                'customer_ID' => 'CUST-0012',
                'customer_name' => 'Maya Indah',
                'email' => 'maya@example.com',
                'password' => '12345678',
                'phone' => '085677889900',
                'total_spend' => 620000,
                'member_points' => 620,
                'tier' => 'Silver', // Poin > 500
            ],
            [
                'customer_ID' => 'CUST-0013',
                'customer_name' => 'Rizky Pratama',
                'email' => 'rizky@example.com',
                'password' => '12345678',
                'phone' => '081922334455',
                'total_spend' => 250000,
                'member_points' => 250,
                'tier' => 'Bronze', // Poin < 500
            ],
            [
                'customer_ID' => 'CUST-0014',
                'customer_name' => 'Diana Lestari',
                'email' => 'diana@example.com',
                'password' => '12345678',
                'phone' => '082144556677',
                'total_spend' => 1450000,
                'member_points' => 1450,
                'tier' => 'Gold', // Poin > 1000
            ],
            [
                'customer_ID' => 'CUST-0015',
                'customer_name' => 'Hendra Wijaya',
                'email' => 'hendra@example.com',
                'password' => '12345678',
                'phone' => '087788991122',
                'total_spend' => 880000,
                'member_points' => 880,
                'tier' => 'Silver', // Poin > 500
            ],
            [
            'customer_ID' => 'CUST-0016',
            'customer_name' => 'Riko Simanjuntak',
            'email' => 'riko@example.com',
            'password' => '12345678',
            'phone' => '081299445566',
            'total_spend' => 1350000,
            'member_points' => 1350,
            'tier' => 'Gold', // Poin > 1000
            ],
            [
            'customer_ID' => 'CUST-0017',
            'customer_name' => 'Siti Badriah',
            'email' => 'badriah@example.com',
            'password' => '12345678',
            'phone' => '085377881122',
            'total_spend' => 480000,
            'member_points' => 480,
            'tier' => 'Bronze', // Poin < 500
            ],
            [
            'customer_ID' => 'CUST-0018',
            'customer_name' => 'Guntur Bumi',
            'email' => 'guntur@example.com',
            'password' => '12345678',
            'phone' => '082155661122',
            'total_spend' => 790000,
            'member_points' => 790,
            'tier' => 'Silver', // Poin > 500
            ],
            [
            'customer_ID' => 'CUST-0019',
            'customer_name' => 'Agnes Monica',
            'email' => 'agnes@example.com',
            'password' => '12345678',
            'phone' => '081188992233',
            'total_spend' => 4200000,
            'member_points' => 4200,
            'tier' => 'Gold', // Poin > 1000
            ],
            [
            'customer_ID' => 'CUST-0020',
            'customer_name' => 'Taufik Savalas',
            'email' => 'taufik@example.com',
            'password' => '12345678',
            'phone' => '087811229900',
            'total_spend' => 150000,
            'member_points' => 150,
            'tier' => 'Bronze', // Poin < 500
            ],
            [
            'customer_ID' => 'CUST-0021',
            'customer_name' => 'Irwan Prayitno',
            'email' => 'irwan@example.com',
            'password' => '12345678',
            'phone' => '081344558899',
            'total_spend' => 680000,
            'member_points' => 680,
            'tier' => 'Silver', // Poin > 500
            ],
            [
            'customer_ID' => 'CUST-0022',
            'customer_name' => 'Wulan Guritno',
            'email' => 'wulan@example.com',
            'password' => '12345678',
            'phone' => '081266778899',
            'total_spend' => 2850000,
            'member_points' => 2850,
            'tier' => 'Gold', // Poin > 1000
            ],  
            [   
            'customer_ID' => 'CUST-0023',
            'customer_name' => 'Desta Mahendra',
            'email' => 'desta@example.com',
            'password' => '12345678',
            'phone' => '085622334455',
            'total_spend' => 520000,
            'member_points' => 520,
            'tier' => 'Silver', // Poin > 500
            ],  
            [   
            'customer_ID' => 'CUST-0024',
            'customer_name' => 'Vincent Rompies',
            'email' => 'vincent@example.com',
            'password' => '12345678',
            'phone' => '081955667788',
            'total_spend' => 910000,
            'member_points' => 910,
            'tier' => 'Silver', // Poin > 500
            ],  
            [   
            'customer_ID' => 'CUST-0025',
            'customer_name' => 'Najwa Shihab',
            'email' => 'najwa@example.com',
            'password' => '12345678',
            'phone' => '081122446688',
            'total_spend' => 3500000,
            'member_points' => 3500,
            'tier' => 'Gold', // Poin > 1000
            ],  
            [   
            'customer_ID' => 'CUST-0026',
            'customer_name' => 'Raditya Dika',
            'email' => 'radika@example.com',
            'password' => '12345678',
            'phone' => '082299887766',
            'total_spend' => 1150000,
            'member_points' => 1150,
            'tier' => 'Gold', // Poin > 1000
            ],
            [
            'customer_ID' => 'CUST-0027',
            'customer_name' => 'Cinta Laura',
            'email' => 'cinta@example.com',
            'password' => '12345678',
            'phone' => '081288776655',
            'total_spend' => 2100000,
            'member_points' => 2100,
            'tier' => 'Gold', // Poin > 1000
            ],
            [
            'customer_ID' => 'CUST-0028',
            'customer_name' => 'Raffi Ahmad',
            'email' => 'raffi@example.com',
            'password' => '12345678',
            'phone' => '081199001122',
            'total_spend' => 5000000,
            'member_points' => 5000,
            'tier' => 'Gold', // Poin > 1000
            ],  
            [   
            'customer_ID' => 'CUST-0029',
            'customer_name' => 'Nagita Slavina',
            'email' => 'nagita@example.com',
            'password' => '12345678',
            'phone' => '081233445511',
            'total_spend' => 4800000,
            'member_points' => 4800,
            'tier' => 'Gold', // Poin > 1000
            ],  
            [   
            'customer_ID' => 'CUST-0030',
            'customer_name' => 'Kaesang Pangarep',
            'email' => 'kaesang@example.com',
            'password' => '12345678',
            'phone' => '085744556677',
            'total_spend' => 350000,
            'member_points' => 350,
            'tier' => 'Bronze', // Poin < 500
            ],  
        ];

        foreach ($customers as $customer) {
            $customer['customer_ID'] = 'CUST-' . str_pad(array_search($customer, $customers) + 1, 4, '0', STR_PAD_LEFT);
            Customer::create($customer);
        }
    }
}