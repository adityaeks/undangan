<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'passcode',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_published' => 'boolean',
        ];
    }

    /**
     * User who owns the invitation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Theme chosen for this invitation.
     */
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Groom and Bride profile data.
     */
    public function couple(): HasOne
    {
        return $this->hasOne(Couple::class);
    }

    /**
     * Event agenda details (Akad, Resepsi, etc.).
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Love story timeline milestones.
     */
    public function stories(): HasMany
    {
        return $this->hasMany(Story::class)->orderBy('order_position');
    }

    /**
     * Photo and video galleries.
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class)->orderBy('order_position');
    }

    /**
     * Digital envelopes and bank accounts.
     */
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * Guest list and RSVP records.
     */
    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    /**
     * Guestbook messages and blessings.
     */
    public function wishes(): HasMany
    {
        return $this->hasMany(Wish::class)->latest();
    }

    /**
     * Orders associated with this invitation.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
