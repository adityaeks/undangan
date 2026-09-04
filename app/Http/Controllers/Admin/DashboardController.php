<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Invitation;
use App\Models\Order;
use App\Models\Theme;
use App\Models\Wish;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with real metric statistics.
     */
    public function index(): View
    {
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
