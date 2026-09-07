<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
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

        $totalInvitations = $user->partnerInvitations()->count();
        $totalClients = $user->partnerClients()->count();
        $recentClients = $user->partnerClients()->latest()->take(5)->get();
        $recentInvitations = $user->partnerInvitations()->with(['theme', 'client'])->latest()->take(5)->get();
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
