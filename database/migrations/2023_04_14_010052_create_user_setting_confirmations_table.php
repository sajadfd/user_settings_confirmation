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
        Schema::create('user_setting_confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_setting_id')->constrained();
            $table->string('confirmation_method');
            $table->string('code');
            $table->dateTime('expiry_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_setting_confirmations');
    }
};
