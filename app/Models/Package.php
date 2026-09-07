<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'target_role',
        'quota_invitations',
        'price',
        'features',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'features' => 'array',
            'is_active' => 'boolean',
            'quota_invitations' => 'integer',
        ];
    }

    /**
     * Users assigned to this package.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
