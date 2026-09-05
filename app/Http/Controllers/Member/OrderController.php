<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of orders and payment invoices for the member.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $query = $user->orders()->with(['items', 'payments', 'coupon']);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        $totalOrders = $user->orders()->count();
        $totalPaid = $user->orders()->where('payment_status', 'paid')->count();
        $totalPending = $user->orders()->where('payment_status', 'pending')->count();
        $totalSpent = (float) $user->orders()->where('payment_status', 'paid')->sum(DB::raw('COALESCE(NULLIF(total_amount, 0), amount)'));

        return view('member.orders.index', compact('orders', 'totalOrders', 'totalPaid', 'totalPending', 'totalSpent'));
    }
}
