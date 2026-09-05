<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartnerClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'name',
        'phone',
        'email',
        'notes',
    ];

    /**
     * Partner who owns this client.
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    /**
     * Invitations created for this client.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'client_id');
    }
}
