<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_histories', function (Blueprint $table) {
            $table->decimal('points_used', 15, 2)->default(0)->after('total_price');
            $table->string('promo_code')->nullable()->after('points_used');
            
            // Ubah default payment_status menjadi UNPAID
            $table->string('payment_status')->default('UNPAID')->change(); 
        });
    }

    public function down(): void
    {
        Schema::table('order_histories', function (Blueprint $table) {
            $table->dropColumn(['points_used', 'promo_code']);
        });
    }
};