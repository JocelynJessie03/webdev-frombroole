<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('pro_ID')->unique();
            $table->string('pro_name');
            $table->text('pro_description')->nullable();
            $table->decimal('pro_price', 15, 2);
            // Hapus pro_stock/pro_currstock dari sini karena stok dihitung dari bahan baku
            $table->string('pro_image')->nullable(); // Kolom image sudah masuk di sini
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Menambahkan foreign key untuk kategori
            $table->boolean('pro_delete')->default(false); // Kolom untuk soft delete manual
            $table->softDeletes(); // Menambahkan soft deletes

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};