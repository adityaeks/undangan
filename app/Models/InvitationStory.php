<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'title',
        'date',
        'year_or_date',
        'story',
        'description',
        'image_url',
        'image',
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
     * Parent invitation.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function getYearOrDateAttribute(): ?string
    {
        return $this->date;
    }

    public function setYearOrDateAttribute(?string $value): void
    {
        $this->attributes['date'] = $value;
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->story;
    }

    public function setDescriptionAttribute(?string $value): void
    {
        $this->attributes['story'] = $value;
    }

    public function getImageAttribute(): ?string
    {
        return $this->image_url;
    }

    public function setImageAttribute(?string $value): void
    {
        $this->attributes['image_url'] = $value;
    }

    public function setOrderPositionAttribute(int $value): void
    {
        $this->attributes['order'] = $value;
    }
}
