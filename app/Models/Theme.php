<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'thumbnail',
        'view_path',
        'is_active',
        'is_premium',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_premium' => 'boolean',
        ];
    }

    /**
     * Get all invitations using this theme.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }
}
