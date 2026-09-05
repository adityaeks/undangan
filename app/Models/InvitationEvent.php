<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'type',
        'title',
        'date',
        'start_time',
        'end_time',
        'timezone',
        'venue_name',
        'address',
        'maps_url',
        'google_maps_url',
        'live_streaming_url',
        'calendar_url',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
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

    public function getGoogleMapsUrlAttribute(): ?string
    {
        return $this->maps_url;
    }

    public function setGoogleMapsUrlAttribute(?string $value): void
    {
        $this->attributes['maps_url'] = $value;
    }

    public function getCalendarUrlAttribute(): ?string
    {
        return $this->live_streaming_url;
    }

    public function setCalendarUrlAttribute(?string $value): void
    {
        $this->attributes['live_streaming_url'] = $value;
    }
}
