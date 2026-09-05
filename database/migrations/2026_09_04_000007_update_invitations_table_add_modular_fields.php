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
        Schema::table('invitations', function (Blueprint $table) {
            if (! Schema::hasColumn('invitations', 'owner_id')) {
                $table->foreignId('owner_id')->nullable()->after('user_id')->constrained('users')->cascadeOnDelete();
            }
            if (! Schema::hasColumn('invitations', 'partner_id')) {
                $table->foreignId('partner_id')->nullable()->after('owner_id')->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('invitations', 'client_id')) {
                $table->foreignId('client_id')->nullable()->after('partner_id')->constrained('partner_clients')->nullOnDelete();
            }
            if (! Schema::hasColumn('invitations', 'status')) {
                $table->string('status')->default('draft')->after('is_published');
            }
            if (! Schema::hasColumn('invitations', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            if (Schema::hasColumn('invitations', 'owner_id')) {
                $table->dropForeign(['owner_id']);
                $table->dropColumn('owner_id');
            }
            if (Schema::hasColumn('invitations', 'partner_id')) {
                $table->dropForeign(['partner_id']);
                $table->dropColumn('partner_id');
            }
            if (Schema::hasColumn('invitations', 'client_id')) {
                $table->dropForeign(['client_id']);
                $table->dropColumn('client_id');
            }
            $dropCols = [];
            foreach (['status', 'published_at'] as $col) {
                if (Schema::hasColumn('invitations', $col)) {
                    $dropCols[] = $col;
                }
            }
            if (! empty($dropCols)) {
                $table->dropColumn($dropCols);
            }
        });
    }
};
