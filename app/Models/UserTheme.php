<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme_id',
        'order_id',
        'unlocked_at',
        'duration_type',
        'expires_at',
        'service_type',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'unlocked_at' => 'datetime',
            'expires_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Determine if this theme access has expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    /**
     * Determine if this theme access is lifetime.
     */
    public function isLifetime(): bool
    {
        return $this->duration_type === 'lifetime' || $this->expires_at === null;
    }

    /**
     * User who owns the theme.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Unlocked theme.
     */
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Order through which theme was purchased.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
