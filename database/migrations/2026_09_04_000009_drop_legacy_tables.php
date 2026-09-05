<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to drop legacy unrefactored tables.
     */
    public function up(): void
    {
        Schema::dropIfExists('wishes');
        Schema::dropIfExists('guests');
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('stories');
        Schema::dropIfExists('events');
        Schema::dropIfExists('couples');

        if (Schema::hasTable('invitation_guests') && ! Schema::hasColumn('invitation_guests', 'attendance_status')) {
            Schema::table('invitation_guests', function (Blueprint $table) {
                $table->string('attendance_status')->default('pending')->after('qr_code');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tables were superseded by modular invitation_* tables
    }
};
