<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'status', 'email_verified_at', 'package_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Package assigned to this user / partner.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get active package for partner. Fallbacks to default starter package if not assigned.
     */
    public function getActivePackageAttribute(): ?Package
    {
        if ($this->relationLoaded('package') && $this->package) {
            return $this->package;
        }

        if ($this->package_id) {
            return $this->package;
        }

        if ($this->isPartner()) {
            return Package::where('slug', 'partner-starter')->first();
        }

        return null;
    }

    /**
     * Get the invitation quota allowed for this partner.
     * 0 or null could mean unlimited.
     */
    public function getInvitationQuotaAttribute(): int
    {
        $package = $this->active_package;
        if (! $package) {
            return 0;
        }

        return (int) $package->quota_invitations;
    }

    /**
     * Check whether the partner can create a new invitation based on package quota.
     * If quota_invitations is 0 (or less), treat as unlimited.
     */
    public function canCreateInvitation(): bool
    {
        if (! $this->isPartner()) {
            return true;
        }

        $quota = $this->invitation_quota;
        if ($quota <= 0) {
            return true;
        }

        $currentCount = $this->partnerInvitations()->count();

        return $currentCount < $quota;
    }

    /**
     * Invitations owned by this user.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'owner_id');
    }

    /**
     * Invitations managed by this partner.
     */
    public function partnerInvitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'partner_id');
    }

    /**
     * Clients registered under this partner.
     */
    public function partnerClients(): HasMany
    {
        return $this->hasMany(PartnerClient::class, 'partner_id');
    }

    /**
     * Themes unlocked/owned by this user.
     */
    public function userThemes(): HasMany
    {
        return $this->hasMany(UserTheme::class);
    }

    /**
     * Themes directly accessible to this user.
     */
    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Theme::class, 'user_themes')
            ->withPivot(['order_id', 'unlocked_at', 'is_active'])
            ->wherePivot('is_active', true)
            ->withTimestamps();
    }

    /**
     * Orders placed by this user.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Check if user is Super Admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is Partner / Reseller / WO.
     */
    public function isPartner(): bool
    {
        return $this->role === 'partner';
    }

    /**
     * Check if user is Member.
     */
    public function isMember(): bool
    {
        return in_array($this->role, ['member', 'user'], true);
    }

    /**
     * Backward-compatible check if user is Regular Customer / Member.
     */
    public function isUser(): bool
    {
        return $this->isMember();
    }

    /**
     * Check if user account is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
