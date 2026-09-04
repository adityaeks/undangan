<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of billing orders & transactions.
     */
    public function index(Request $request): View
    {
        $query = Order::with(['user', 'invitation']);

        if ($request->filled('search')) {
            $query->where('order_code', 'like', "%{$request->search}%");
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        $orders = $query->latest()->paginate(10);
        $totalRevenue = Order::where('payment_status', 'paid')->sum('amount');
        $totalPaid = Order::where('payment_status', 'paid')->count();
        $totalPending = Order::where('payment_status', 'pending')->count();

        return view('admin.orders.index', compact('orders', 'totalRevenue', 'totalPaid', 'totalPending'));
    }
}
