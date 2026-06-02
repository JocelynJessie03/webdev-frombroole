<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ========== BRONZE TIER TASKS ==========
        
        // GENERAL PURCHASE TASKS
        $task1 = Task::create([
            'title'                   => 'First Purchase',
            'description'             => 'Make your first purchase to unlock rewards',
            'required_tier'           => 'Bronze',
            'task_type'               => 'general',
            'points_reward'           => 10,
            'min_purchases_required'  => 1,
            'order_count'             => 1,
            'is_active'               => true,
        ]);

        $task2 = Task::create([
            'title'                   => 'Bronze Loyalty',
            'description'             => 'Complete 3 orders to earn loyalty points',
            'required_tier'           => 'Bronze',
            'task_type'               => 'general',
            'points_reward'           => 15,
            'min_purchases_required'  => 3,
            'order_count'             => 3,
            'is_active'               => true,
        ]);

        $task3 = Task::create([
            'title'                   => 'Morning Coffee Lover',
            'description'             => 'Purchase any product 5 times',
            'required_tier'           => 'Bronze',
            'task_type'               => 'general',
            'points_reward'           => 20,
            'min_purchases_required'  => 5,
            'order_count'             => 5,
            'is_active'               => true,
        ]);

        $task4 = Task::create([
            'title'                   => 'Weekly Shopper',
            'description'             => 'Make purchases in 2 different weeks',
            'required_tier'           => 'Bronze',
            'task_type'               => 'general',
            'points_reward'           => 25,
            'min_purchases_required'  => 2,
            'order_count'             => 2,
            'is_active'               => true,
        ]);

        // PRODUCT-SPECIFIC TASKS (Attach products by name containing certain keywords)
        $matchaProducts = Product::where('pro_name', 'like', '%Matcha%')->pluck('id')->toArray();
        if (!empty($matchaProducts)) {
            $task5 = Task::create([
                'title'                   => '🍵 Matcha Day',
                'description'             => 'Try our premium Matcha collection and get rewarded',
                'required_tier'           => 'Bronze',
                'task_type'               => 'product_specific',
                'points_reward'           => 30,
                'min_purchases_required'  => 1,
                'order_count'             => 1,
                'is_active'               => true,
            ]);
            $task5->products()->sync($matchaProducts);
        }

        $oreoProducts = Product::where('pro_name', 'like', '%Oreo%')->pluck('id')->toArray();
        if (!empty($oreoProducts)) {
            $task6 = Task::create([
                'title'                   => '🍪 Oreo Crunch',
                'description'             => 'Enjoy our delicious Oreo-topped treats',
                'required_tier'           => 'Bronze',
                'task_type'               => 'product_specific',
                'points_reward'           => 25,
                'min_purchases_required'  => 1,
                'order_count'             => 1,
                'is_active'               => true,
            ]);
            $task6->products()->sync($oreoProducts);
        }

        // ========== SILVER TIER TASKS ==========

        $task7 = Task::create([
            'title'                   => 'Silver Milestone',
            'description'             => 'Upgrade to Silver tier and complete first task',
            'required_tier'           => 'Silver',
            'task_type'               => 'general',
            'points_reward'           => 30,
            'min_purchases_required'  => 5,
            'order_count'             => 5,
            'is_active'               => true,
        ]);

        $task8 = Task::create([
            'title'                   => 'Regular Patron',
            'description'             => 'Complete 10 orders as a Silver member',
            'required_tier'           => 'Silver',
            'task_type'               => 'general',
            'points_reward'           => 50,
            'min_purchases_required'  => 10,
            'order_count'             => 10,
            'is_active'               => true,
        ]);

        $chocolateProducts = Product::where('pro_name', 'like', '%Chocolate%')->pluck('id')->toArray();
        if (!empty($chocolateProducts)) {
            $task9 = Task::create([
                'title'                   => '🍫 Chocolate Bliss',
                'description'             => 'Indulge in our premium Chocolate selections',
                'required_tier'           => 'Silver',
                'task_type'               => 'product_specific',
                'points_reward'           => 40,
                'min_purchases_required'  => 2,
                'order_count'             => 2,
                'is_active'               => true,
            ]);
            $task9->products()->sync($chocolateProducts);
        }

        $tiramisuProducts = Product::where('pro_name', 'like', '%Tiramisu%')->pluck('id')->toArray();
        if (!empty($tiramisuProducts)) {
            $task10 = Task::create([
                'title'                   => '☕ Tiramisu Lover',
                'description'             => 'Experience our classic Tiramisu creations',
                'required_tier'           => 'Silver',
                'task_type'               => 'product_specific',
                'points_reward'           => 35,
                'min_purchases_required'  => 1,
                'order_count'             => 1,
                'is_active'               => true,
            ]);
            $task10->products()->sync($tiramisuProducts);
        }

        $task11 = Task::create([
            'title'                   => 'Silver Collector',
            'description'             => 'Collect 3 different coupons as a Silver member',
            'required_tier'           => 'Silver',
            'task_type'               => 'general',
            'points_reward'           => 35,
            'min_purchases_required'  => 7,
            'order_count'             => 3,
            'is_active'               => true,
        ]);

        // ========== GOLD TIER TASKS ==========

        $task12 = Task::create([
            'title'                   => '👑 VIP Welcome',
            'description'             => 'Congratulations on reaching Gold tier! Enjoy exclusive benefits',
            'required_tier'           => 'Gold',
            'task_type'               => 'general',
            'points_reward'           => 60,
            'min_purchases_required'  => 15,
            'order_count'             => 15,
            'is_active'               => true,
        ]);

        $task13 = Task::create([
            'title'                   => 'Gold Champion',
            'description'             => 'Complete 25 orders as a Gold member',
            'required_tier'           => 'Gold',
            'task_type'               => 'general',
            'points_reward'           => 100,
            'min_purchases_required'  => 25,
            'order_count'             => 25,
            'is_active'               => true,
        ]);

        // Connoisseur Collection - Try all major flavors
        $allProducts = Product::limit(5)->pluck('id')->toArray();
        if (!empty($allProducts)) {
            $task14 = Task::create([
                'title'                   => '🎨 Connoisseur Collection',
                'description'             => 'Master all our specialty flavors',
                'required_tier'           => 'Gold',
                'task_type'               => 'product_specific',
                'points_reward'           => 80,
                'min_purchases_required'  => 5,
                'order_count'             => 5,
                'is_active'               => true,
            ]);
            $task14->products()->sync($allProducts);
        }

        $task15 = Task::create([
            'title'                   => 'Ultimate Collector',
            'description'             => 'Collect all available coupons',
            'required_tier'           => 'Gold',
            'task_type'               => 'general',
            'points_reward'           => 80,
            'min_purchases_required'  => 20,
            'order_count'             => 20,
            'is_active'               => true,
        ]);

        $task16 = Task::create([
            'title'                   => '🌟 Loyal Legend',
            'description'             => 'Be a Gold member for 90 days with continuous purchases',
            'required_tier'           => 'Gold',
            'task_type'               => 'general',
            'points_reward'           => 120,
            'min_purchases_required'  => 30,
            'order_count'             => 30,
            'is_active'               => true,
        ]);

        $task17 = Task::create([
            'title'                   => '💎 Big Spender Elite',
            'description'             => 'Spend Rp 2.000.000 or more total',
            'required_tier'           => 'Gold',
            'task_type'               => 'general',
            'points_reward'           => 150,
            'min_purchases_required'  => 35,
            'order_count'             => 35,
            'is_active'               => true,
        ]);
    }
}
