<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Theme;
use App\Services\MidtransService;
use App\Services\PaymentService;
use App\Services\ThemeOwnershipService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // If user still has an available unused license for this theme, redirect to use it unless explicitly purchasing an additional license
        if ($this->themeOwnershipService->hasUnusedLicense($user, $theme) && ! $request->boolean('additional')) {
            return redirect()->route('member.invitations.create', ['theme_id' => $theme->id])
                ->with('info', 'Anda masih memiliki lisensi aktif yang belum digunakan untuk template "'.$theme->name.'". Silakan gunakan untuk membuat undangan digital Anda.');
        }

        $duration = $request->query('duration', '45_days');
        if (! in_array($duration, ['45_days', 'lifetime'], true)) {
            $duration = '45_days';
        }

        $serviceType = $request->query('service_type', 'self_service');
        if (! in_array($serviceType, ['self_service', 'assisted'], true)) {
            $serviceType = 'self_service';
        }

        // Check if there is already an existing pending order for this theme
        $existingOrder = Order::where('user_id', $user->id)
            ->where('payment_status', 'pending')
            ->whereHas('items', fn ($q) => $q->where('item_type', 'theme')->where('item_id', $theme->id))
            ->latest()
            ->first();

        if ($existingOrder) {
            if ($existingOrder->isExpired()) {
                $existingOrder->update(['status' => 'failed', 'payment_status' => 'failed']);
            } else {
                $currentDuration = $existingOrder->metadata['duration'] ?? '45_days';
                $currentService = $existingOrder->metadata['service_type'] ?? 'self_service';

                if ($currentDuration === $duration && $currentService === $serviceType) {
                    return redirect()->route('orders.show', $existingOrder);
                }

                // If user modified their package options, recreate the pending order with new options
                $existingOrder->delete();
            }
        }

        $order = $this->paymentService->createOrderForTheme($user, $theme, $duration, $serviceType);

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
    public function show(Request $request, Order $order): View|RedirectResponse
    {
        if ($order->user_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        if ($order->isPending() && $order->isExpired()) {
            $order->update(['status' => 'failed', 'payment_status' => 'failed']);
        }

        // If order is already paid and accessed directly (not from dashboard transaction history), redirect to success page
        if ($order->isPaid() && ! $request->filled('from')) {
            return redirect()->route('orders.success', $order);
        }

        $order->load(['items', 'payments', 'coupon']);

        $snapToken = (! $order->isPaid() && ! $order->isExpired()) ? $this->midtransService->getSnapToken($order) : null;
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
     * Show order payment success page.
     */
    public function success(Request $request, Order $order): View|RedirectResponse
    {
        if ($order->user_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        if (! $order->isPaid()) {
            return redirect()->route('orders.show', $order);
        }

        $order->load(['items', 'payments', 'coupon']);

        $waNumber = Setting::get('support_whatsapp_number', '');
        $cleanWa = preg_replace('/[^0-9]/', '', (string) $waNumber);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62'.substr($cleanWa, 1);
        }

        $themeItem = $order->items->where('item_type', 'theme')->first();
        $themeName = $themeItem ? $themeItem->item_name : 'Tema Undangan';
        $waMessage = urlencode("Halo Tim Admin KlikMomen, saya telah menyelesaikan pembayaran untuk pesanan {$order->order_code} ({$themeName}). Saya memilih layanan Diisikan Tim, berikut saya lampirkan data dan foto untuk undangan pernikahan saya.");
        $waUrl = ! empty($cleanWa) ? "https://wa.me/{$cleanWa}?text={$waMessage}" : '#';

        return view('orders.success', compact(
            'order',
            'waNumber',
            'cleanWa',
            'waUrl',
            'themeItem'
        ));
    }

    /**
     * Display printable order invoice.
     */
    public function invoice(Request $request, Order $order): View
    {
        if ($order->user_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        $order->load(['items', 'payments', 'coupon', 'user']);

        return view('orders.invoice', compact('order'));
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

        // ponytail: transaction+lock to avoid max_uses race; throttle is at route layer
        return DB::transaction(function () use ($order, $validated) {
            $code = strtoupper(trim($validated['code']));
            $coupon = Coupon::where('code', $code)->lockForUpdate()->first();

            $error = null;
            if (! $coupon || ! $coupon->isValidForAmount((float) $order->amount, $error)) {
                return back()->with('error', $error ?? 'Kode kupon "'.$code.'" tidak valid atau tidak ditemukan.');
            }

            $discount = $coupon->calculateDiscount((float) $order->amount);
            $taxableAmount = max(0, (float) $order->amount - $discount);
            $taxAmount = round($taxableAmount * 0.11);
            $total = $taxableAmount + $taxAmount;

            $order->update([
                'coupon_id' => $coupon->id,
                'discount' => $discount,
                'tax_amount' => $taxAmount,
                'total_amount' => $total,
                'snap_token' => null,
            ]);

            return back()->with('success', 'Kupon '.$coupon->code.' berhasil diterapkan!');
        });
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

        $taxAmount = round((float) $order->amount * 0.11);
        $total = (float) $order->amount + $taxAmount;

        $order->update([
            'coupon_id' => null,
            'discount' => 0.00,
            'tax_amount' => $taxAmount,
            'total_amount' => $total,
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

        $params = ['order' => $order];
        if ($request->filled('from')) {
            $params['from'] = $request->input('from');
        }

        return redirect()->route('orders.success', $params)
            ->with('success', 'Pembayaran berhasil dikonfirmasi! Template sekarang aktif di akun Anda.');
    }
}
