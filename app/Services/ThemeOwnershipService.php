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
        if ($user->isSuperAdmin() || $user->isPartner() || $theme->isFree()) {
            return true;
        }

        // If editing existing invitation that is already bound to this theme, allow
        if ($invitation && (int) $invitation->theme_id === (int) $theme->id) {
            return true;
        }

        // Check if user has at least one available unassigned license slot
        return $this->getAvailableLicensesCount($user, $theme) > 0;
    }

    /**
     * Unlock a theme license for a user idempotently with variant and expiration metadata.
     */
    public function unlockThemeForUser(User $user, Theme $theme, ?Order $order = null): UserTheme
    {
        $duration = $order?->metadata['duration'] ?? '45_days';
        $serviceType = $order?->metadata['service_type'] ?? 'self_service';

        $expiresAt = null;
        if ($duration === '45_days') {
            $expiresAt = now()->addDays(45);
        }

        // When fulfilling an order, match strictly by order_id and theme_id for idempotency
        if ($order) {
            return UserTheme::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'theme_id' => $theme->id,
                ],
                [
                    'user_id' => $user->id,
                    'unlocked_at' => now(),
                    'duration_type' => $duration,
                    'expires_at' => $expiresAt,
                    'service_type' => $serviceType,
                    'is_active' => true,
                ]
            );
        }

        // Without an order (e.g. manual grant or free theme), reuse an existing unassigned slot or create one
        $existing = UserTheme::where('user_id', $user->id)
            ->where('theme_id', $theme->id)
            ->whereNull('order_id')
            ->whereNull('invitation_id')
            ->first();

        if ($existing) {
            $existing->update([
                'unlocked_at' => now(),
                'duration_type' => $duration,
                'expires_at' => $expiresAt,
                'service_type' => $serviceType,
                'is_active' => true,
            ]);

            return $existing;
        }

        return UserTheme::create([
            'user_id' => $user->id,
            'theme_id' => $theme->id,
            'order_id' => null,
            'unlocked_at' => now(),
            'duration_type' => $duration,
            'expires_at' => $expiresAt,
            'service_type' => $serviceType,
            'is_active' => true,
        ]);
    }

    /**
     * Assign an available theme license to a newly created or updated invitation.
     */
    public function assignThemeLicenseToInvitation(User $user, Theme $theme, Invitation $invitation): ?UserTheme
    {
        if ($user->isSuperAdmin() || $user->isPartner()) {
            return null;
        }

        // Check if already assigned to this invitation
        $alreadyAssigned = UserTheme::where('user_id', $user->id)
            ->where('theme_id', $theme->id)
            ->where('invitation_id', $invitation->id)
            ->first();

        if ($alreadyAssigned) {
            return $alreadyAssigned;
        }

        // Find the oldest active unexpired available license
        $availableLicense = UserTheme::where('user_id', $user->id)
            ->where('theme_id', $theme->id)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->whereNull('invitation_id')
            ->orderByRaw('expires_at IS NULL, expires_at ASC')
            ->first();

        if ($availableLicense) {
            $availableLicense->update(['invitation_id' => $invitation->id]);

            return $availableLicense;
        }

        return null;
    }

    /**
     * Release a theme license from an invitation (e.g. when deleted or theme changed).
     */
    public function releaseThemeLicenseFromInvitation(Invitation $invitation): void
    {
        UserTheme::where('invitation_id', $invitation->id)
            ->update(['invitation_id' => null]);
    }

    /**
     * Determine if a user has an unused active license for a theme.
     */
    public function hasUnusedLicense(User $user, Theme $theme): bool
    {
        if ($user->isSuperAdmin() || $user->isPartner() || $theme->isFree()) {
            return true;
        }

        return $this->getAvailableLicensesCount($user, $theme) > 0;
    }

    /**
     * Get total active licenses count owned by user for a theme.
     */
    public function getTotalLicensesCount(User $user, Theme $theme): int
    {
        return UserTheme::where('user_id', $user->id)
            ->where('theme_id', $theme->id)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->count();
    }

    /**
     * Get used licenses count for a theme by user.
     */
    public function getUsedLicensesCount(User $user, Theme $theme): int
    {
        $explicitlyLinked = UserTheme::where('user_id', $user->id)
            ->where('theme_id', $theme->id)
            ->where('is_active', true)
            ->whereNotNull('invitation_id')
            ->count();

        $invitationsCount = $user->invitations()->where('theme_id', $theme->id)->count();

        return max($explicitlyLinked, min($invitationsCount, $this->getTotalLicensesCount($user, $theme)));
    }

    /**
     * Get available (unassigned) licenses count for a theme by user.
     */
    public function getAvailableLicensesCount(User $user, Theme $theme): int
    {
        $total = $this->getTotalLicensesCount($user, $theme);
        $used = $this->getUsedLicensesCount($user, $theme);

        return max(0, $total - $used);
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

    /**
     * Get array of theme IDs that have at least one available unassigned license for a new invitation.
     *
     * @return array<int>
     */
    public function getUserAvailableThemeIdsForNewInvitation(User $user): array
    {
        if ($user->isSuperAdmin()) {
            return Theme::where('is_active', true)->pluck('id')->all();
        }

        if ($user->isPartner()) {
            return Theme::where('is_active', true)->where('is_for_partner', true)->pluck('id')->all();
        }

        $ownedThemeIds = $this->getUserOwnedThemeIds($user);
        $availableIds = [];

        foreach ($ownedThemeIds as $themeId) {
            $theme = Theme::find($themeId);
            if ($theme && $this->getAvailableLicensesCount($user, $theme) > 0) {
                $availableIds[] = $themeId;
            }
        }

        $freeIds = Theme::where('is_active', true)->where('is_premium', false)->pluck('id')->all();

        return array_values(array_unique(array_merge($availableIds, $freeIds)));
    }
}
