<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of billing orders & transactions.
     */
    public function index(Request $request): View
    {
        $query = Order::with(['user', 'invitation', 'coupon']);

        if ($request->filled('search')) {
            $query->where('order_code', 'like', "%{$request->search}%");
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        $orders = $query->latest()->paginate(10);
        $totalRevenue = (float) Order::where('payment_status', 'paid')->sum(DB::raw('COALESCE(NULLIF(total_amount, 0), amount)'));
        $totalPaid = Order::where('payment_status', 'paid')->count();
        $totalPending = Order::where('payment_status', 'pending')->count();

        return view('admin.orders.index', compact('orders', 'totalRevenue', 'totalPaid', 'totalPending'));
    }
}
