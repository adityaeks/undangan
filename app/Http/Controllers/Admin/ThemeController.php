<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ThemeController extends Controller
{
    /**
     * Display a listing of wedding themes.
     */
    public function index(Request $request): View
    {
        $query = Theme::withCount('invitations');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $themes = $query->get();
        $totalThemes = Theme::count();
        $totalActive = Theme::where('is_active', true)->count();
        $totalPremium = Theme::where('is_premium', true)->count();

        return view('admin.themes.index', compact('themes', 'totalThemes', 'totalActive', 'totalPremium'));
    }

    /**
     * Toggle theme active status.
     */
    public function toggleActive(Theme $theme): RedirectResponse
    {
        $theme->update(['is_active' => ! $theme->is_active]);
        $status = $theme->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Tema {$theme->name} berhasil {$status}.");
    }

    /**
     * Update theme price and premium status.
     */
    public function updatePrice(Request $request, Theme $theme): RedirectResponse
    {
        $validated = $request->validate([
            'price' => ['required', 'numeric', 'min:0'],
            'is_premium' => ['nullable', 'boolean'],
        ]);

        $theme->update([
            'price' => $validated['price'],
            'is_premium' => $request->boolean('is_premium', $validated['price'] > 0),
        ]);

        return back()->with('success', "Harga tema {$theme->name} berhasil diperbarui menjadi Rp ".number_format($theme->price, 0, ',', '.').'.');
    }
}
