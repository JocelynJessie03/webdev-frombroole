<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_value', 10, 2); // e.g. 10 = 10% or Rp10.000
            $table->decimal('minimum_purchase', 15, 2)->default(0);
            $table->integer('max_uses')->nullable();       // null = unlimited
            $table->integer('used_count')->default(0);
            $table->date('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('synced_at')->nullable();
        });

        // Pivot: track which customer claimed which task coupon
        Schema::create('customer_task', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignUuid('task_id')->constrained('tasks')->onDelete('cascade');
            $table->enum('status', ['claimed', 'used'])->default('claimed');
            $table->string('coupon_code')->nullable(); // assigned coupon code
            $table->timestamp('claimed_at')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->unique(['customer_id', 'task_id']);
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('synced_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_task');
        Schema::dropIfExists('discount_coupons');
    }
};