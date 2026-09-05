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
        Schema::table('themes', function (Blueprint $table) {
            if (! Schema::hasColumn('themes', 'price')) {
                $table->decimal('price', 12, 2)->default(0.00)->after('view_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('themes', function (Blueprint $table) {
            if (Schema::hasColumn('themes', 'price')) {
                $table->dropColumn('price');
            }
        });
    }
};
