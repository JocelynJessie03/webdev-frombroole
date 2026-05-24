<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Cek dulu, apakah kolom deleted_at BELUM ada?
            if (!Schema::hasColumn('products', 'deleted_at')) {
                $table->softDeletes(); // Jika belum ada, baru buat kolomnya
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Ini untuk membatalkan (drop) kolom jika terjadi rollback
            $table->dropSoftDeletes(); 
        });
    }
};