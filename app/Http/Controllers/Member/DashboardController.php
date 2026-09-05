<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Member Dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $invitation = $user->invitations()
            ->with(['theme', 'couple', 'guests', 'events', 'wishes', 'wallets', 'setting'])
            ->latest()
            ->first();

        $myGuestsCount = $invitation ? $invitation->guests->count() : 0;
        $myConfirmedGuestsCount = $invitation ? $invitation->guests->where('attendance_status', 'hadir')->count() : 0;
        $myWishesCount = $invitation ? $invitation->wishes->count() : 0;
        $recentWishes = $invitation ? $invitation->wishes->take(5) : collect();
        $couple = $invitation?->couple;
        $mainEvent = $invitation?->events->first();

        $unlockedThemes = $user->themes;

        return view('member.dashboard', compact(
            'invitation',
            'myGuestsCount',
            'myConfirmedGuestsCount',
            'myWishesCount',
            'recentWishes',
            'couple',
            'mainEvent',
            'unlockedThemes'
        ));
    }
}
