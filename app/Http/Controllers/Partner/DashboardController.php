<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display Partner Dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $totalInvitations = Invitation::query()
            ->where(function ($query) use ($user) {
                $query->where('partner_id', $user->id)
                    ->orWhere('owner_id', $user->id)
                    ->orWhere('user_id', $user->id);
            })
            ->count();
        $totalClients = $user->partnerClients()->count();
        $recentClients = $user->partnerClients()->latest()->take(5)->get();
        $recentInvitations = Invitation::query()
            ->where(function ($query) use ($user) {
                $query->where('partner_id', $user->id)
                    ->orWhere('owner_id', $user->id)
                    ->orWhere('user_id', $user->id);
            })
            ->with(['theme', 'client'])
            ->latest()
            ->take(5)
            ->get();
        $activePackage = $user->active_package;
        $invitationQuota = $user->invitation_quota;
        $canCreateInvitation = $user->canCreateInvitation();

        return view('partner.dashboard', compact(
            'totalInvitations',
            'totalClients',
            'recentClients',
            'recentInvitations',
            'activePackage',
            'invitationQuota',
            'canCreateInvitation'
        ));
    }
}
