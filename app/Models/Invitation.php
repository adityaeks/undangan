<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'owner_id',
        'partner_id',
        'client_id',
        'theme_id',
        'title',
        'slug',
        'event_type',
        'event_date',
        'background_music',
        'quote_text',
        'quote_source',
        'cover_image',
        'is_published',
        'status',
        'published_at',
        'expires_at',
        'passcode',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    /**
     * Determine if this invitation has expired.
     */
    public function isExpired(): bool
    {
        if ($this->expires_at !== null && $this->expires_at->isPast()) {
            return true;
        }

        if ($this->relationLoaded('userTheme') && $this->userTheme && $this->userTheme->isExpired()) {
            return true;
        }

        return false;
    }

    /**
     * Generate unique URL slug for invitation.
     */
    public static function generateUniqueSlug(string $baseText, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($baseText) ?: 'undangan';
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    /**
     * Clear public cached page data for this invitation.
     */
    public function clearPublicCache(): void
    {
        if (! empty($this->slug)) {
            clear_invitation_cache($this->slug);
        }
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saved(function (Invitation $invitation) {
            $invitation->clearPublicCache();
        });

        static::deleting(function (Invitation $invitation) {
            delete_storage_file($invitation->cover_image);
            delete_storage_file($invitation->background_music);

            foreach ($invitation->couples as $couple) {
                delete_storage_file($couple->photo_url);
            }

            foreach ($invitation->media as $media) {
                delete_storage_file($media->url ?? $media->file_url);
            }

            foreach ($invitation->stories as $story) {
                delete_storage_file($story->image_url);
            }
        });

        static::deleted(function (Invitation $invitation) {
            $invitation->clearPublicCache();
        });
    }

    /**
     * Owner of the invitation (Customer or Partner).
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Partner (WO/Agency) who manages this invitation.
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    /**
     * Client record under partner.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(PartnerClient::class, 'client_id');
    }

    /**
     * Backward-compatible user relationship.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Theme chosen for this invitation.
     */
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * UserTheme license slot tied to this invitation.
     */
    public function userTheme(): HasOne
    {
        return $this->hasOne(UserTheme::class);
    }

    /**
     * Modular invitation settings.
     */
    public function setting(): HasOne
    {
        return $this->hasOne(InvitationSetting::class);
    }

    /**
     * Modular couple entries (Groom & Bride rows).
     */
    public function couples(): HasMany
    {
        return $this->hasMany(InvitationCouple::class)->orderBy('order');
    }

    /**
     * Couple relationship for groom entry.
     */
    public function couple(): HasOne
    {
        return $this->hasOne(InvitationCouple::class)->where('role', 'groom');
    }

    /**
     * Backward-compatible couple object accessor combining groom and bride.
     */
    public function getCoupleAttribute(): ?object
    {
        $couples = $this->relationLoaded('couples') ? $this->couples : $this->couples()->get();
        $groom = $couples->firstWhere('role', 'groom');
        $bride = $couples->firstWhere('role', 'bride');

        if (! $groom && ! $bride) {
            return null;
        }

        return (object) [
            'groom_name' => $groom?->full_name ?? '',
            'groom_nickname' => $groom?->nickname ?? $groom?->full_name ?? '',
            'groom_father' => $groom?->father_name ?? '',
            'groom_mother' => $groom?->mother_name ?? '',
            'groom_instagram' => $groom?->instagram ?? '',
            'groom_photo' => $groom?->photo_url ?? '',
            'bride_name' => $bride?->full_name ?? '',
            'bride_nickname' => $bride?->nickname ?? $bride?->full_name ?? '',
            'bride_father' => $bride?->father_name ?? '',
            'bride_mother' => $bride?->mother_name ?? '',
            'bride_instagram' => $bride?->instagram ?? '',
            'bride_photo' => $bride?->photo_url ?? '',
        ];
    }

    /**
     * Event agenda details.
     */
    public function events(): HasMany
    {
        return $this->hasMany(InvitationEvent::class)->orderBy('order');
    }

    /**
     * Love story timeline milestones.
     */
    public function stories(): HasMany
    {
        return $this->hasMany(InvitationStory::class)->orderBy('order');
    }

    /**
     * Media galleries.
     */
    public function media(): HasMany
    {
        return $this->hasMany(InvitationMedia::class)->orderBy('order');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(InvitationMedia::class)->whereIn('media_type', ['photo', 'gallery'])->orderBy('order');
    }

    /**
     * Gifts and digital wallets.
     */
    public function gifts(): HasMany
    {
        return $this->hasMany(InvitationGift::class)->orderBy('order');
    }

    public function wallets(): HasMany
    {
        return $this->hasMany(InvitationGift::class)->orderBy('order');
    }

    /**
     * Guest list and RSVP records.
     */
    public function guests(): HasMany
    {
        return $this->hasMany(InvitationGuest::class);
    }

    /**
     * Guestbook messages and blessings.
     */
    public function wishes(): HasMany
    {
        return $this->hasMany(InvitationWish::class)->latest();
    }

    /**
     * Orders associated with this invitation.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Default WhatsApp invitation greeting template.
     */
    public static function defaultWhatsappTemplate(): string
    {
        return "Kepada Yth.\nBapak/Ibu/Saudara/i *[nama]*\n\nTanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara pernikahan kami.\n\nInformasi lengkap & konfirmasi kehadiran:\n[link]\n\nMerupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.\n\nTerima kasih.";
    }

    /**
     * Get configured WhatsApp invitation template or default.
     */
    public function getWhatsappTemplateAttribute(): string
    {
        return $this->setting?->metadata['whatsapp_template'] ?? static::defaultWhatsappTemplate();
    }

    /**
     * Build formatted WhatsApp invitation message for a recipient.
     */
    public function formatWhatsappMessage(string $guestName, ?string $link = null): string
    {
        $link = $link ?: route('invitation.show', ['slug' => $this->slug, 'to' => $guestName]);
        $template = $this->whatsapp_template;

        return str_replace(
            ['[nama]', '{nama}', '[link]', '{link}'],
            [$guestName, $guestName, $link, $link],
            $template
        );
    }
}
