<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationGift extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'gift_type',
        'bank_name',
        'account_number',
        'account_name',
        'qr_code_url',
        'qris_image',
        'recipient_address',
        'gift_address',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    /**
     * Parent invitation.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function getGiftAddressAttribute(): ?string
    {
        return $this->recipient_address;
    }

    public function setGiftAddressAttribute(?string $value): void
    {
        $this->attributes['recipient_address'] = $value;
    }

    public function getQrisImageAttribute(): ?string
    {
        return $this->qr_code_url;
    }

    public function setQrisImageAttribute(?string $value): void
    {
        $this->attributes['qr_code_url'] = $value;
    }
}
