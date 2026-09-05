<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'min_spend',
        'max_uses',
        'used_count',
        'is_active',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'discount_value' => 'decimal:2',
            'min_spend' => 'decimal:2',
            'used_count' => 'integer',
            'max_uses' => 'integer',
            'is_active' => 'boolean',
            'expires_at' => 'datetime',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isValidForAmount(float $amount, ?string &$error = null): bool
    {
        if (! $this->is_active) {
            $error = 'Kupon ini sudah tidak aktif.';

            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            $error = 'Kupon ini sudah kedaluwarsa.';

            return false;
        }

        if ($this->max_uses && $this->used_count >= $this->max_uses) {
            $error = 'Kupon ini telah mencapai batas pemakaian maksimum.';

            return false;
        }

        if ($this->min_spend > 0 && $amount < (float) $this->min_spend) {
            $error = 'Minimal transaksi untuk kupon ini adalah Rp '.number_format($this->min_spend, 0, ',', '.');

            return false;
        }

        return true;
    }

    public function calculateDiscount(float $amount): float
    {
        $discount = $this->discount_type === 'percent'
            ? ($amount * ((float) $this->discount_value / 100))
            : (float) $this->discount_value;

        return min($amount, round($discount, 2));
    }
}
