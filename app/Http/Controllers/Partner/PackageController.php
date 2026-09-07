<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    /**
     * Display partner packages and subscription status.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $packages = Package::where('target_role', 'partner')
            ->where('is_active', true)
            ->orderBy('price')
            ->get();

        $activePackage = $user->active_package;
        $invitationCount = $user->partnerInvitations()->count();
        $invitationQuota = $user->invitation_quota;

        return view('partner.packages.index', compact(
            'packages',
            'activePackage',
            'invitationCount',
            'invitationQuota'
        ));
    }

    /**
     * Select / upgrade to a partner package via checkout.
     */
    public function select(Request $request, Package $package): RedirectResponse
    {
        abort_if($package->target_role !== 'partner', 404);

        return redirect()->route('checkout.package', $package);
    }
}
