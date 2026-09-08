<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerController extends Controller
{
    /**
     * Display the Wedding Organizer & Reseller Partner management page.
     */
    public function index(): View
    {
        $packages = Package::where('target_role', 'partner')
            ->orderBy('price')
            ->get();

        $partners = User::where('role', 'partner')
            ->with(['package'])
            ->withCount('partnerInvitations')
            ->latest()
            ->paginate(15);

        $totalPartners = User::where('role', 'partner')->count();
        $totalPartnerInvitations = Invitation::whereNotNull('partner_id')->count();

        return view('admin.partners.index', compact(
            'packages',
            'partners',
            'totalPartners',
            'totalPartnerInvitations'
        ));
    }

    /**
     * Update configuration for a specific partner package.
     */
    public function updatePackage(Request $request, Package $package): RedirectResponse
    {
        if ($request->has('price')) {
            $request->merge([
                'price' => preg_replace('/[^0-9]/', '', (string) $request->input('price')),
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota_invitations' => 'required|integer|min:0',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $features = [];
        if (! empty($validated['features'])) {
            $rawFeatures = preg_split('/\r\n|\r|\n/', (string) $validated['features']);
            $features = array_values(array_filter(array_map('trim', $rawFeatures), fn ($line) => $line !== ''));
        }

        $package->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quota_invitations' => $validated['quota_invitations'],
            'features' => $features,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('success', "Pengaturan paket '{$package->name}' berhasil disimpan.");
    }

    /**
     * Assign / change package for a partner.
     */
    public function updateUserPackage(Request $request, User $user): RedirectResponse
    {
        abort_if(! $user->isPartner(), 400, 'Pengguna bukan berstatus Partner.');

        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        $package = Package::where('target_role', 'partner')->findOrFail($validated['package_id']);

        $user->update([
            'package_id' => $package->id,
        ]);

        return back()->with('success', "Paket untuk partner {$user->name} berhasil diubah ke {$package->name}.");
    }
}
