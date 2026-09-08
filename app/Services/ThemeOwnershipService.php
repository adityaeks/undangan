<?php

namespace App\Services;

use App\Models\Invitation;
use App\Models\Order;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserTheme;

class ThemeOwnershipService
{
    /**
     * Determine if a user has permission to use a theme.
     */
    public function canUseTheme(User $user, Theme $theme): bool
    {
        // Super admin can use all themes
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Partner can use active themes provided for partners by super admin
        if ($user->isPartner() && $theme->is_active && $theme->is_for_partner) {
            return true;
        }

        // Free themes can be used by anyone
        if ($theme->isFree()) {
            return true;
        }

        // Check if user has an active, unexpired ownership record
        return UserTheme::query()
            ->where('user_id', $user->id)
            ->where('theme_id', $theme->id)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->exists();
    }

    /**
     * Determine if a user can use a theme for creating or updating an invitation (1 theme license = 1 invitation rule for members).
     */
    public function canUseThemeForInvitation(User $user, Theme $theme, ?Invitation $invitation = null): bool
    {
        if (! $this->canUseTheme($user, $theme)) {
            return false;
        }

        // Super Admin and Partner have no per-theme invitation limits (Partner uses package invitation_quota)
        if ($user->isSuperAdmin() || $user->isPartner()) {
            return true;
        }

        // For regular members: 1 theme license can only be used for 1 invitation.
        $query = $user->invitations()->where('theme_id', $theme->id);

        if ($invitation) {
            $query->where('id', '!=', $invitation->id);
        }

        return $query->count() < 1;
    }

    /**
     * Unlock a theme for a user idempotently with variant and expiration metadata.
     */
    public function unlockThemeForUser(User $user, Theme $theme, ?Order $order = null): UserTheme
    {
        $duration = $order?->metadata['duration'] ?? '45_days';
        $serviceType = $order?->metadata['service_type'] ?? 'self_service';

        $expiresAt = null;
        if ($duration === '45_days') {
            $expiresAt = now()->addDays(45);
        }

        return UserTheme::updateOrCreate(
            [
                'user_id' => $user->id,
                'theme_id' => $theme->id,
            ],
            [
                'order_id' => $order?->id,
                'unlocked_at' => now(),
                'duration_type' => $duration,
                'expires_at' => $expiresAt,
                'service_type' => $serviceType,
                'is_active' => true,
            ]
        );
    }

    /**
     * Get array of theme IDs unlocked/owned by the user.
     *
     * @return array<int>
     */
    public function getUserOwnedThemeIds(User $user): array
    {
        if ($user->isSuperAdmin()) {
            return Theme::pluck('id')->all();
        }

        if ($user->isPartner()) {
            return Theme::where('is_active', true)->where('is_for_partner', true)->pluck('id')->all();
        }

        $ownedIds = UserTheme::where('user_id', $user->id)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->pluck('theme_id')
            ->all();
        $freeIds = Theme::where('is_premium', false)->pluck('id')->all();

        return array_values(array_unique(array_merge($ownedIds, $freeIds)));
    }
}
