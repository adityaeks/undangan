<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationWish extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'guest_name',
        'relationship',
        'message',
        'attendance_status',
        'attendance',
        'is_approved',
        'is_hidden',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }

    /**
     * Parent invitation.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function getAttendanceAttribute(): ?string
    {
        return $this->attendance_status;
    }

    public function setAttendanceAttribute(?string $value): void
    {
        $this->attributes['attendance_status'] = $value;
    }

    public function getIsHiddenAttribute(): bool
    {
        return ! ($this->is_approved ?? true);
    }

    public function setIsHiddenAttribute(?bool $value): void
    {
        $this->attributes['is_approved'] = ! $value;
    }

    public function getSenderNameAttribute(): string
    {
        return $this->guest_name;
    }
}
