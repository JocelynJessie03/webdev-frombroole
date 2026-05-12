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
        Schema::create('product', function (Blueprint $table) {
    $table->string('pro_ID')->primary();
    $table->string('pro_name');
    $table->text('pro_description')->nullable();
    $table->decimal('pro_price', 10, 2);
    $table->integer('pro_currstock');
    $table->boolean('pro_delete')->default(false);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
