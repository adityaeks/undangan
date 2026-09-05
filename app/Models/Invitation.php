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
        'passcode',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
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
        return $this->hasMany(InvitationMedia::class)->orderBy('order');
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
}
