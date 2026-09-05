<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationCouple extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'role',
        'full_name',
        'nickname',
        'father_name',
        'mother_name',
        'child_number',
        'instagram',
        'photo_url',
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
}
