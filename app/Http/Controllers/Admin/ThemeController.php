<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
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
        $totalPartner = Theme::where('is_for_partner', true)->count();

        $globalPrice45 = (float) Setting::get('theme_price_45_days', 49000);
        $globalPriceLifetime = (float) Setting::get('theme_price_lifetime', 99000);
        $globalAssistedFee = (float) Setting::get('theme_assisted_fee', 25000);
        $whatsappNumber = (string) Setting::get('support_whatsapp_number', '');

        return view('admin.themes.index', compact(
            'themes',
            'totalThemes',
            'totalActive',
            'totalPremium',
            'totalPartner',
            'globalPrice45',
            'globalPriceLifetime',
            'globalAssistedFee',
            'whatsappNumber'
        ));
    }

    /**
     * Update global pricing and service fee settings.
     */
    public function updateGlobalPricing(Request $request): RedirectResponse
    {
        $request->merge([
            'price_45_days' => preg_replace('/[^0-9]/', '', (string) $request->input('price_45_days')),
            'price_lifetime' => preg_replace('/[^0-9]/', '', (string) $request->input('price_lifetime')),
            'assisted_fee' => preg_replace('/[^0-9]/', '', (string) $request->input('assisted_fee')),
        ]);

        $validated = $request->validate([
            'price_45_days' => ['required', 'numeric', 'min:0'],
            'price_lifetime' => ['required', 'numeric', 'min:0'],
            'assisted_fee' => ['required', 'numeric', 'min:0'],
            'whatsapp_number' => ['nullable', 'string', 'max:30'],
        ]);

        Setting::set('theme_price_45_days', $validated['price_45_days']);
        Setting::set('theme_price_lifetime', $validated['price_lifetime']);
        Setting::set('theme_assisted_fee', $validated['assisted_fee']);
        Setting::set('support_whatsapp_number', $validated['whatsapp_number'] ?? '');

        return back()->with('success', 'Pengaturan harga varian (45 Hari & Lifetime) serta biaya jasa berhasil diperbarui.');
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
        $request->merge([
            'price' => preg_replace('/[^0-9]/', '', (string) $request->input('price')),
            'price_lifetime' => $request->filled('price_lifetime') && preg_replace('/[^0-9]/', '', (string) $request->input('price_lifetime')) !== ''
                ? preg_replace('/[^0-9]/', '', (string) $request->input('price_lifetime'))
                : null,
        ]);

        $validated = $request->validate([
            'price' => ['required', 'numeric', 'min:0'],
            'price_lifetime' => ['nullable', 'numeric', 'min:0'],
            'is_premium' => ['nullable', 'boolean'],
        ]);

        $metadata = $theme->metadata ?? [];
        if ($request->filled('price_lifetime')) {
            $metadata['price_lifetime'] = (float) $validated['price_lifetime'];
        } else {
            unset($metadata['price_lifetime']);
        }

        $theme->update([
            'price' => $validated['price'],
            'metadata' => $metadata,
            'is_premium' => $request->boolean('is_premium', $validated['price'] > 0),
        ]);

        return back()->with('success', "Harga tema {$theme->name} berhasil diperbarui (45 Hari: ".format_rupiah($theme->getPrice45Days()).', Lifetime: '.format_rupiah($theme->getLifetimePrice()).').');
    }

    /**
     * Toggle theme availability for partner workspace.
     */
    public function togglePartner(Theme $theme): RedirectResponse
    {
        $theme->update(['is_for_partner' => ! $theme->is_for_partner]);
        $status = $theme->is_for_partner ? 'diaktifkan untuk partner' : 'dinonaktifkan dari partner';

        return back()->with('success', "Ketersediaan tema {$theme->name} berhasil {$status}.");
    }
}
