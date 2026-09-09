<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Services\ThemeOwnershipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ThemeController extends Controller
{
    public function __construct(
        protected ThemeOwnershipService $themeOwnershipService,
    ) {}

    /**
     * Display a listing of themes that the member has purchased and are active.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $query = Theme::query()->where('is_active', true);
        } else {
            $query = $user->themes()->where('themes.is_active', true);
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('themes.category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('themes.name', 'like', "%{$search}%");
        }

        $themes = $query->distinct()->orderBy('themes.name', 'asc')->get()->map(function ($theme) use ($user) {
            $theme->is_owned = true;

            $totalLicenses = $this->themeOwnershipService->getTotalLicensesCount($user, $theme);
            $usedLicenses = $this->themeOwnershipService->getUsedLicensesCount($user, $theme);
            $availableLicenses = $this->themeOwnershipService->getAvailableLicensesCount($user, $theme);

            $theme->total_licenses = $totalLicenses;
            $theme->used_licenses = $usedLicenses;
            $theme->available_licenses = $availableLicenses;
            $theme->is_used = $totalLicenses > 0 && $availableLicenses === 0 && ! $user->isSuperAdmin();

            return $theme;
        });

        $categories = $user->isSuperAdmin()
            ? Theme::where('is_active', true)->distinct()->pluck('category')->filter()->values()
            : $user->themes()->where('themes.is_active', true)->distinct()->pluck('themes.category')->filter()->values();

        $totalOwned = $user->isSuperAdmin()
            ? Theme::where('is_active', true)->count()
            : $user->themes()->count();

        $totalActive = $user->isSuperAdmin()
            ? Theme::where('is_active', true)->count()
            : count($this->themeOwnershipService->getUserOwnedThemeIds($user));

        $totalCatalogThemes = Theme::where('is_active', true)->count();

        return view('member.themes.index', compact('themes', 'categories', 'totalOwned', 'totalActive', 'totalCatalogThemes'));
    }
}
