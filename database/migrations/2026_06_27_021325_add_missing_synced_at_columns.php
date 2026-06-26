<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            'users', 'categories', 'products', 'ingredients', 'ingredient_product',
            'customers', 'order_histories', 'order_items', 'admins', 
            'ingredient_histories', 'notifications', 'tasks', 'discount_coupons', 
            'task_product', 'contact_messages', 'coupon_usages'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'synced_at')) {
                Schema::table($table, function (Blueprint $tableSchema) {
                    $tableSchema->timestamp('synced_at')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not dropping them safely because they might have been added by original migrations
    }
};
