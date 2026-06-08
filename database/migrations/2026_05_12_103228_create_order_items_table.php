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
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('order_id')->constrained('order_histories')->onDelete('cascade');
            $table->foreignUuid('product_id')->constrained('products');
            $table->integer('quantity');
            $table->decimal('price_at_purchase', 15, 2); // Harga saat dibeli
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('synced_at')->nullable();
            $table->integer('sugar_level')->default(100); // Tambahan kolom untuk tingkat gula
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
