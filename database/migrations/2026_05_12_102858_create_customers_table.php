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
            Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('customer_ID')->unique(); // Contoh: CUST-001
        $table->string('customer_name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('phone');
        $table->decimal('total_spend', 15, 2)->default(0);
        $table->integer('member_points')->default(0);
        $table->enum('tier', ['Bronze', 'Silver', 'Gold'])->default('Bronze');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
