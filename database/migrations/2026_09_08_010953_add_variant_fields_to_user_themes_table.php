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
        Schema::table('user_themes', function (Blueprint $table) {
            if (! Schema::hasColumn('user_themes', 'duration_type')) {
                $table->string('duration_type')->default('45_days')->after('unlocked_at');
            }
            if (! Schema::hasColumn('user_themes', 'expires_at')) {
                $table->timestamp('expires_at')->nullable()->after('duration_type');
            }
            if (! Schema::hasColumn('user_themes', 'service_type')) {
                $table->string('service_type')->default('self_service')->after('expires_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_themes', function (Blueprint $table) {
            $dropCols = [];
            foreach (['duration_type', 'expires_at', 'service_type'] as $col) {
                if (Schema::hasColumn('user_themes', $col)) {
                    $dropCols[] = $col;
                }
            }
            if (! empty($dropCols)) {
                $table->dropColumn($dropCols);
            }
        });
    }
};
