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
            // Andi Wijaya (CUST-0003) - Total: 80,000
            [
                'customer_id' => 3,
                'order_date' => now()->subDays(2),
                'total_items' => 2,
                'total_price' => 80000,
                'status' => 'Complete',
            ],
            // Guest User (CUST-0004) - No orders (0 total_spend)
        ];

        foreach ($ordersData as $index => $order) {
            $order['order_id'] = 'INV-' . $order['order_date']->format('Ymd') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            OrderHistory::create($order);
        }
    }
}
