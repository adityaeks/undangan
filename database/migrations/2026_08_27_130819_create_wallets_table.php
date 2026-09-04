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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->cascadeOnDelete();
            $table->string('bank_name'); // BCA, Mandiri, BRI, BNI, Dana, Gopay, QRIS, etc.
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('qris_image')->nullable();
            $table->text('gift_address')->nullable(); // Alamat pengiriman kado fisik
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
