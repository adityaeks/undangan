<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Package;
use App\Models\Theme;
use App\Services\MidtransService;
use App\Services\PaymentService;
use App\Services\ThemeOwnershipService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService,
        protected ThemeOwnershipService $themeOwnershipService,
        protected MidtransService $midtransService,
    ) {}

    /**
     * Initiate checkout for a theme template.
     */
    public function checkoutTheme(Request $request, Theme $theme): RedirectResponse
    {
        $user = $request->user();

        // If theme is free, unlock immediately
        if ($theme->isFree()) {
            $this->themeOwnershipService->unlockThemeForUser($user, $theme);

            return redirect()->route('member.dashboard')->with('success', 'Template berhasil diaktifkan ke akun Anda!');
        }

        // If already owned
        if ($this->themeOwnershipService->canUseTheme($user, $theme)) {
            return redirect()->route('member.invitations.create', ['theme_id' => $theme->id])
                ->with('info', 'Anda sudah memiliki template ini. Silakan buat undangan digital Anda.');
        }

        // Check if there is already an existing pending order for this theme
        $existingOrder = Order::where('user_id', $user->id)
            ->where('payment_status', 'pending')
            ->whereHas('items', fn ($q) => $q->where('item_type', 'theme')->where('item_id', $theme->id))
            ->latest()
            ->first();

        if ($existingOrder) {
            return redirect()->route('orders.show', $existingOrder);
        }

        $order = $this->paymentService->createOrderForTheme($user, $theme);

        return redirect()->route('orders.show', $order);
    }

    /**
     * Initiate checkout for a package subscription.
     */
    public function checkoutPackage(Request $request, Package $package): RedirectResponse
    {
        $user = $request->user();
        $order = $this->paymentService->createOrderForPackage($user, $package);

        return redirect()->route('orders.show', $order);
    }

    /**
     * Show order payment detail page.
     */
    public function show(Request $request, Order $order): View
    {
        if ($order->user_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        $order->load(['items', 'payments', 'coupon']);

        $snapToken = ! $order->isPaid() ? $this->midtransService->getSnapToken($order) : null;
        $snapJsUrl = $this->midtransService->getSnapJsUrl();
        $midtransClientKey = $this->midtransService->getClientKey();
        $isMidtransConfigured = $this->midtransService->isConfigured();

        return view('orders.show', compact(
            'order',
            'snapToken',
            'snapJsUrl',
            'midtransClientKey',
            'isMidtransConfigured'
        ));
    }

    /**
     * Apply coupon code to order.
     */
    public function applyCoupon(Request $request, Order $order): RedirectResponse
    {
        if ($order->user_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        if ($order->isPaid()) {
            return back()->with('error', 'Pesanan yang sudah lunas tidak dapat diubah kuponnya.');
        }

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50'],
        ]);

        $code = strtoupper(trim($validated['code']));
        $coupon = Coupon::where('code', $code)->first();

        $error = null;
        if (! $coupon || ! $coupon->isValidForAmount((float) $order->amount, $error)) {
            return back()->with('error', $error ?? 'Kode kupon "'.$code.'" tidak valid atau tidak ditemukan.');
        }

        $discount = $coupon->calculateDiscount((float) $order->amount);
        $total = max(0, (float) $order->amount - $discount);

        $order->update([
            'coupon_id' => $coupon->id,
            'discount' => $discount,
            'total_amount' => $total,
            'snap_token' => null,
        ]);

        return back()->with('success', 'Kupon '.$coupon->code.' berhasil diterapkan!');
    }

    /**
     * Remove applied coupon from order.
     */
    public function removeCoupon(Request $request, Order $order): RedirectResponse
    {
        if ($order->user_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        if ($order->isPaid()) {
            return back()->with('error', 'Pesanan yang sudah lunas tidak dapat diubah kuponnya.');
        }

        $order->update([
            'coupon_id' => null,
            'discount' => 0.00,
            'total_amount' => $order->amount,
            'snap_token' => null,
        ]);

        return back()->with('success', 'Kupon berhasil dihapus.');
    }

    /**
     * Simulate payment success for development / testing.
     */
    public function simulatePayment(Request $request, Order $order): RedirectResponse
    {
        if ($order->user_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        $this->paymentService->processSuccessfulPayment(
            $order,
            'SIM-'.time(),
            'simulation',
            ['source' => 'manual_simulation']
        );

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pembayaran berhasil dikonfirmasi! Template sekarang aktif di akun Anda.');
    }
}
