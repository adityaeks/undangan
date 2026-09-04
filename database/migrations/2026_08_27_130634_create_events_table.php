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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->cascadeOnDelete();
            $table->string('title'); // e.g. "Akad Nikah", "Resepsi Pernikahan", "Pemberkatan"
            $table->date('date');
            $table->string('start_time')->default('08:00 WIB');
            $table->string('end_time')->nullable();
            $table->string('timezone')->default('WIB');
            $table->string('venue_name');
            $table->text('address')->nullable();
            $table->string('google_maps_url')->nullable();
            $table->string('calendar_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
