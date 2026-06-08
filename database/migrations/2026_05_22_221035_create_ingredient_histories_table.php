<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ingredient_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // Relasi ke tabel ingredients
            $table->foreignUuid('ingredient_id')->constrained('ingredients')->onDelete('cascade');
            $table->bigInteger('amount'); // Berapa banyak yang keluar/masuk
            $table->string('type'); // 'in' (stok masuk) atau 'out' (stok keluar)
            $table->date('date'); // Tanggal aktivitas
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('synced_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredient_histories');
    }
};