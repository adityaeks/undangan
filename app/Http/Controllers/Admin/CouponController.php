<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    /**
     * Display a listing of promo coupons.
     */
    public function index(): View
    {
        $coupons = Coupon::withCount('orders')->latest()->paginate(15);
        $totalCoupons = Coupon::count();
        $totalActive = Coupon::where('is_active', true)->count();
        $totalUsage = Coupon::sum('used_count');

        return view('admin.coupons.index', compact('coupons', 'totalCoupons', 'totalActive', 'totalUsage'));
    }

    /**
     * Store a newly created coupon in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code'],
            'discount_type' => ['required', 'in:percent,fixed'],
            'discount_value' => ['required', 'numeric', 'min:0.01'],
            'min_spend' => ['nullable', 'numeric', 'min:0'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'expires_at' => ['nullable', 'date'],
        ]);

        $code = strtoupper(trim($validated['code']));

        Coupon::create([
            'code' => $code,
            'discount_type' => $validated['discount_type'],
            'discount_value' => $validated['discount_value'],
            'min_spend' => $validated['min_spend'] ?? 0.00,
            'max_uses' => $validated['max_uses'] ?? null,
            'expires_at' => $validated['expires_at'] ?? null,
            'is_active' => true,
        ]);

        return back()->with('success', "Kupon promo {$code} berhasil dibuat!");
    }

    /**
     * Toggle coupon active state.
     */
    public function toggleActive(Coupon $coupon): RedirectResponse
    {
        $coupon->update([
            'is_active' => ! $coupon->is_active,
        ]);

        $status = $coupon->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Kupon {$coupon->code} berhasil {$status}.");
    }

    /**
     * Remove coupon from database.
     */
    public function destroy(Coupon $coupon): RedirectResponse
    {
        $code = $coupon->code;
        $coupon->delete();

        return back()->with('success', "Kupon {$code} berhasil dihapus.");
    }
}
