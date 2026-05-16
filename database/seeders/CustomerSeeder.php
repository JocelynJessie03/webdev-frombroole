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
                'phone' => '081111111111',
                'total_spend' => 0,
                'member_points' => 0,
                'tier' => 'Bronze',
            ],
        ];

        foreach ($customers as $customer) {
            $customer['customer_ID'] = 'CUST-' . str_pad(array_search($customer, $customers) + 1, 4, '0', STR_PAD_LEFT);
            Customer::create($customer);
        }
    }
}