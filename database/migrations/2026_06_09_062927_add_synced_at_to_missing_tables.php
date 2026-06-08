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
        $tables = [
            'categories',
            'products',
            'ingredients',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'synced_at')) {
                    $table->timestamp('synced_at')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'categories',
            'products',
            'ingredients',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'synced_at')) {
                    $table->dropColumn('synced_at');
                }
            });
        }
    }
};
