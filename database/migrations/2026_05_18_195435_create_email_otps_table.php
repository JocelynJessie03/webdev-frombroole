<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_otps', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name');

            $table->string('email');

            $table->string('password');

            $table->string('otp');

            $table->timestamp('expires_at');

            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('synced_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_otps');
    }
};