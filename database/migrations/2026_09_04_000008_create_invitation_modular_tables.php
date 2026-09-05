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
        // 1. Settings
        if (! Schema::hasTable('invitation_settings')) {
            Schema::create('invitation_settings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('invitation_id')->unique()->constrained('invitations')->cascadeOnDelete();
                $table->string('bg_music_url')->nullable();
                $table->boolean('is_music_autoplay')->default(false);
                $table->text('quote_text')->nullable();
                $table->string('quote_source')->nullable();
                $table->boolean('enable_comments')->default(true);
                $table->boolean('enable_rsvp')->default(true);
                $table->string('custom_domain')->nullable();
                $table->json('metadata')->nullable();
                $table->timestamps();
            });
        }

        // 2. Couples
        if (! Schema::hasTable('invitation_couples')) {
            Schema::create('invitation_couples', function (Blueprint $table) {
                $table->id();
                $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete();
                $table->string('role')->default('groom'); // groom, bride
                $table->string('full_name');
                $table->string('nickname')->nullable();
                $table->string('father_name')->nullable();
                $table->string('mother_name')->nullable();
                $table->string('child_number')->nullable();
                $table->string('instagram')->nullable();
                $table->string('photo_url')->nullable();
                $table->integer('order')->default(1);
                $table->timestamps();
            });
        }

        // 3. Events
        if (! Schema::hasTable('invitation_events')) {
            Schema::create('invitation_events', function (Blueprint $table) {
                $table->id();
                $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete();
                $table->string('type')->default('wedding'); // akad, resepsi, pemberkatan, etc.
                $table->string('title');
                $table->date('date');
                $table->string('start_time')->nullable();
                $table->string('end_time')->nullable();
                $table->string('timezone')->default('WIB');
                $table->string('venue_name');
                $table->text('address')->nullable();
                $table->text('maps_url')->nullable();
                $table->string('live_streaming_url')->nullable();
                $table->integer('order')->default(1);
                $table->timestamps();
            });
        }

        // 4. Stories
        if (! Schema::hasTable('invitation_stories')) {
            Schema::create('invitation_stories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete();
                $table->string('title');
                $table->string('date')->nullable();
                $table->text('story');
                $table->string('image_url')->nullable();
                $table->integer('order')->default(1);
                $table->timestamps();
            });
        }

        // 5. Media
        if (! Schema::hasTable('invitation_media')) {
            Schema::create('invitation_media', function (Blueprint $table) {
                $table->id();
                $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete();
                $table->string('media_type')->default('photo'); // photo, video, youtube
                $table->string('url');
                $table->string('caption')->nullable();
                $table->integer('order')->default(1);
                $table->timestamps();
            });
        }

        // 6. Gifts
        if (! Schema::hasTable('invitation_gifts')) {
            Schema::create('invitation_gifts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete();
                $table->string('gift_type')->default('bank_transfer'); // bank_transfer, ewallet, physical_gift
                $table->string('bank_name')->nullable();
                $table->string('account_number')->nullable();
                $table->string('account_name')->nullable();
                $table->string('qr_code_url')->nullable();
                $table->text('recipient_address')->nullable();
                $table->integer('order')->default(1);
                $table->timestamps();
            });
        }

        // 7. Guests
        if (! Schema::hasTable('invitation_guests')) {
            Schema::create('invitation_guests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete();
                $table->string('slug');
                $table->string('name');
                $table->string('phone')->nullable();
                $table->string('category')->default('General');
                $table->integer('pax')->default(1);
                $table->string('qr_code')->nullable();
                $table->string('attendance_status')->default('pending');
                $table->boolean('is_invited')->default(true);
                $table->timestamps();

                $table->index(['invitation_id', 'slug']);
            });
        }

        // 8. Wishes
        if (! Schema::hasTable('invitation_wishes')) {
            Schema::create('invitation_wishes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete();
                $table->string('guest_name');
                $table->string('relationship')->nullable();
                $table->text('message');
                $table->string('attendance_status')->default('attending'); // attending, not_attending, tentative
                $table->boolean('is_approved')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_wishes');
        Schema::dropIfExists('invitation_guests');
        Schema::dropIfExists('invitation_gifts');
        Schema::dropIfExists('invitation_media');
        Schema::dropIfExists('invitation_stories');
        Schema::dropIfExists('invitation_events');
        Schema::dropIfExists('invitation_couples');
        Schema::dropIfExists('invitation_settings');
    }
};
