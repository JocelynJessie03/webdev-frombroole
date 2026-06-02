<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('task_type', ['general', 'product_specific'])->default('general')->after('required_tier')->comment('general = any purchase, product_specific = specific products only');
        });

        Schema::create('task_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unique(['task_id', 'product_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_product');
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('task_type');
        });
    }
};
