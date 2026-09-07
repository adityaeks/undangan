<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'invitation_id',
        'coupon_id',
        'order_code',
        'package_type',
        'amount',
        'discount',
        'total_amount',
        'payment_status',
        'status',
        'payment_method',
        'snap_token',
        'metadata',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'discount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'metadata' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    /**
     * Applied coupon for this order.
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * User who placed this order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Invitation related to this order.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    /**
     * Order items breakdown.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Payment attempts / records for this order.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Themes unlocked by this order.
     */
    public function userThemes(): HasMany
    {
        return $this->hasMany(UserTheme::class);
    }

    /**
     * Bootstrap model events.
     */
    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (empty($order->uuid)) {
                $order->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Get route key name for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Retrieve the model for a bound value with backward-compatible fallback for numeric ID.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'uuid', $value)
            ->when(is_numeric($value), fn ($query) => $query->orWhere('id', $value))
            ->first() ?? abort(404);
    }

    /**
     * Check if order is fully paid.
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid' || $this->payment_status === 'paid';
    }
}
