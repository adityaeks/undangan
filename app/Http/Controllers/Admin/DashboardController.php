<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Invitation;
use App\Models\InvitationGuest as Guest;
use App\Models\InvitationWish as Wish;
use App\Models\Order;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Admin Super Admin Dashboard with platform governance metrics.
     */
    public function index(): View
    {
        $totalUsers = User::count();
        $totalMembers = User::whereIn('role', ['member', 'user'])->count();
        $totalPartners = User::where('role', 'partner')->count();

        $totalInvitations = Invitation::count();
        $totalActiveInvitations = Invitation::where('is_published', true)->count();

        $totalOrders = Order::count();
        $totalRevenue = (float) Order::where('payment_status', 'paid')->sum(DB::raw('COALESCE(NULLIF(total_amount, 0), amount)'));

        $totalPaidOrders = Order::where('payment_status', 'paid')->count();
        $totalPendingOrders = Order::where('payment_status', 'pending')->count();

        $totalThemes = Theme::count();
        $totalCoupons = Coupon::count();
        $totalGuests = Guest::count();
        $totalConfirmedGuests = Guest::where('attendance_status', 'hadir')->count();

        $recentOrders = Order::with(['user', 'coupon'])->latest()->take(6)->get();
        $recentUsers = User::latest()->take(6)->get();
        $recentInvitations = Invitation::with(['owner', 'theme', 'couple'])->latest()->take(6)->get();
        $recentWishes = Wish::with('invitation')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalMembers',
            'totalPartners',
            'totalInvitations',
            'totalActiveInvitations',
            'totalOrders',
            'totalRevenue',
            'totalPaidOrders',
            'totalPendingOrders',
            'totalThemes',
            'totalCoupons',
            'totalGuests',
            'totalConfirmedGuests',
            'recentOrders',
            'recentUsers',
            'recentInvitations',
            'recentWishes'
        ));
    }
}
