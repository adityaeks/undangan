<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
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
}
