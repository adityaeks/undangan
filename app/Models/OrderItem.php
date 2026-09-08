<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_type',
        'item_id',
        'item_name',
        'price',
        'quantity',
        'subtotal',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'quantity' => 'integer',
        ];
    }

    /**
     * Parent order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Clean item name accessor ensuring duration labels are not duplicated in theme title.
     */
    protected function itemName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): string => preg_replace('/\s*\((?:lifetime|\d+\s*hari).*$/i', '', (string) $value),
        );
    }
}
