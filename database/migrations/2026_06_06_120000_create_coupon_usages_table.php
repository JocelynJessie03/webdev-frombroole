<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupon_usages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignUuid('coupon_id')->constrained('discount_coupons')->onDelete('cascade');
            $table->unsignedBigInteger('order_history_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('synced_at')->nullable();

            // Satu customer hanya bisa pakai satu kupon sekali
            $table->unique(['customer_id', 'coupon_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupon_usages');
    }
};
