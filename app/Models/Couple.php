<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Couple extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'groom_name',
        'groom_nickname',
        'groom_father',
        'groom_mother',
        'groom_instagram',
        'groom_photo',
        'bride_name',
        'bride_nickname',
        'bride_father',
        'bride_mother',
        'bride_instagram',
        'bride_photo',
    ];

    /**
     * Invitation this couple data belongs to.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
