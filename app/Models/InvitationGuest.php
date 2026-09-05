<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'slug',
        'slug_url',
        'name',
        'phone',
        'phone_number',
        'category',
        'group',
        'pax',
        'pax_confirmed',
        'qr_code',
        'is_invited',
        'attendance_status',
    ];

    protected function casts(): array
    {
        return [
            'pax' => 'integer',
            'is_invited' => 'boolean',
        ];
    }

    /**
     * Parent invitation.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function getPhoneNumberAttribute(): ?string
    {
        return $this->phone;
    }

    public function setPhoneNumberAttribute(?string $value): void
    {
        $this->attributes['phone'] = $value;
    }

    public function getGroupAttribute(): ?string
    {
        return $this->category;
    }

    public function setGroupAttribute(?string $value): void
    {
        $this->attributes['category'] = $value;
    }

    public function getPaxConfirmedAttribute(): int
    {
        return $this->pax ?? 1;
    }

    public function setPaxConfirmedAttribute(?int $value): void
    {
        $this->attributes['pax'] = $value ?? 1;
    }

    public function getSlugUrlAttribute(): ?string
    {
        return $this->slug;
    }

    public function setSlugUrlAttribute(?string $value): void
    {
        $this->attributes['slug'] = $value;
    }

    public function getAttendanceStatusAttribute(): string
    {
        return $this->attributes['attendance_status'] ?? 'pending';
    }

    public function setAttendanceStatusAttribute(?string $value): void
    {
        $this->attributes['attendance_status'] = $value;
    }
}
