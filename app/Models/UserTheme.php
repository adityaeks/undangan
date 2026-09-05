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
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'unlocked_at' => 'datetime',
            'is_active' => 'boolean',
        ];
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
