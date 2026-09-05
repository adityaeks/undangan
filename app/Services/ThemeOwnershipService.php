<?php

namespace App\Services;

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

        // Free themes can be used by anyone
        if ($theme->isFree()) {
            return true;
        }

        // Check if user has an active ownership record
        return UserTheme::query()
            ->where('user_id', $user->id)
            ->where('theme_id', $theme->id)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Unlock a theme for a user idempotently.
     */
    public function unlockThemeForUser(User $user, Theme $theme, ?Order $order = null): UserTheme
    {
        return UserTheme::updateOrCreate(
            [
                'user_id' => $user->id,
                'theme_id' => $theme->id,
            ],
            [
                'order_id' => $order?->id,
                'unlocked_at' => now(),
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

        $ownedIds = UserTheme::where('user_id', $user->id)
            ->where('is_active', true)
            ->pluck('theme_id')
            ->all();
        $freeIds = Theme::where('is_premium', false)->pluck('id')->all();

        return array_values(array_unique(array_merge($ownedIds, $freeIds)));
    }
}
