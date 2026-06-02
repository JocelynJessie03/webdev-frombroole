<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('min_purchases_required')->default(1)->comment('Minimum products customer must have purchased');
            $table->integer('order_count')->after('points_reward')->default(1)->comment('Minimum number of orders required to claim task');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['min_purchases_required', 'order_count']);
        });
    }
};
