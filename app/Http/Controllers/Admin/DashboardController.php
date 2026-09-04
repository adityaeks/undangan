<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Invitation;
use App\Models\Order;
use App\Models\Theme;
use App\Models\Wish;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Dashboard with role-specific views and metrics.
     */
    public function index(): View
    {
        $user = Auth::user();

        if ($user && ! $user->isSuperAdmin()) {
            $invitation = $user->invitations()->with(['theme', 'couple', 'guests', 'events', 'wishes', 'wallets'])->latest()->first();

            $myGuestsCount = $invitation ? $invitation->guests()->count() : 0;
            $myConfirmedGuestsCount = $invitation ? $invitation->guests()->where('attendance_status', 'hadir')->count() : 0;
            $myWishesCount = $invitation ? $invitation->wishes()->count() : 0;
            $recentWishes = $invitation ? $invitation->wishes()->latest()->take(5)->get() : collect();
            $couple = $invitation?->couple;
            $mainEvent = $invitation?->events()->first();

            return view('member.dashboard', compact(
                'invitation',
                'myGuestsCount',
                'myConfirmedGuestsCount',
                'myWishesCount',
                'recentWishes',
                'couple',
                'mainEvent'
            ));
        }

        $totalInvitations = Invitation::count();
        $totalGuests = Guest::count();
        $totalConfirmedGuests = Guest::where('attendance_status', 'hadir')->count();
        $totalThemes = Theme::count();
        $totalOrders = Order::count();
        $recentInvitations = Invitation::with(['theme', 'couple', 'guests', 'events'])->latest()->take(5)->get();
        $recentWishes = Wish::with('invitation')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalInvitations',
            'totalGuests',
            'totalConfirmedGuests',
            'totalThemes',
            'totalOrders',
            'recentInvitations',
            'recentWishes'
        ));
    }
}
