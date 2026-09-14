<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'media_type',
        'url',
        'file_url',
        'caption',
        'order',
        'order_position',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (InvitationMedia $media) {
            delete_storage_file($media->url ?? $media->file_url);
        });
    }

    /**
     * Parent invitation.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    /**
     * Backward-compatible file_url attribute.
     */
    public function getFileUrlAttribute(): string
    {
        return $this->url;
    }

    public function setFileUrlAttribute(string $value): void
    {
        $this->attributes['url'] = $value;
    }

    public function setOrderPositionAttribute(int $value): void
    {
        $this->attributes['order'] = $value;
    }
}
