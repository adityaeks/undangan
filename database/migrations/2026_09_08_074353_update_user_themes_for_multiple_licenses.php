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
            // Add index on user_id first so the foreign key on user_id has a backing index
            $table->index('user_id', 'user_themes_user_id_index');
            $table->index(['user_id', 'theme_id'], 'user_themes_user_id_theme_id_index');

            // Drop unique index to allow multiple licenses per user for the same theme
            $table->dropUnique('user_themes_user_id_theme_id_unique');

            // Add foreign key linking a license to a specific invitation
            $table->foreignId('invitation_id')->nullable()->after('order_id')->constrained('invitations')->nullOnDelete();
        });

        // Backfill existing invitations with matching user_themes
        $invitations = DB::table('invitations')->whereNotNull('theme_id')->orderBy('id', 'asc')->get();
        foreach ($invitations as $inv) {
            DB::table('user_themes')
                ->where('user_id', $inv->user_id)
                ->where('theme_id', $inv->theme_id)
                ->whereNull('invitation_id')
                ->limit(1)
                ->update(['invitation_id' => $inv->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_themes', function (Blueprint $table) {
            $table->dropForeign(['invitation_id']);
            $table->dropColumn('invitation_id');
            $table->dropIndex(['user_id', 'theme_id']);
            $table->unique(['user_id', 'theme_id']);
        });
    }
};
