<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'bg_music_url',
        'is_music_autoplay',
        'quote_text',
        'quote_source',
        'enable_comments',
        'enable_rsvp',
        'custom_domain',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'is_music_autoplay' => 'boolean',
            'enable_comments' => 'boolean',
            'enable_rsvp' => 'boolean',
            'metadata' => 'array',
        ];
    }

    /**
     * Parent invitation.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
