<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentService
{
    public function __construct(
        protected ThemeOwnershipService $themeOwnershipService,
    ) {}

    /**
     * Create a purchase order for a theme.
     */
    public function createOrderForTheme(User $user, Theme $theme): Order
    {
        return DB::transaction(function () use ($user, $theme) {
            $price = (float) $theme->price;
            $orderCode = 'ORD-THM-'.strtoupper(Str::random(8));

            $order = Order::create([
                'user_id' => $user->id,
                'order_code' => $orderCode,
                'package_type' => 'single_template',
                'amount' => $price,
                'total_amount' => $price,
                'payment_status' => 'pending',
                'status' => 'pending',
            ]);

            $order->items()->create([
                'item_type' => 'theme',
                'item_id' => $theme->id,
                'item_name' => 'Template: '.$theme->name,
                'price' => $price,
                'quantity' => 1,
                'subtotal' => $price,
            ]);

            return $order;
        });
    }

    /**
     * Create a purchase order for a package.
     */
    public function createOrderForPackage(User $user, Package $package): Order
    {
        return DB::transaction(function () use ($user, $package) {
            $price = (float) $package->price;
            $orderCode = 'ORD-PKG-'.strtoupper(Str::random(8));

            $order = Order::create([
                'user_id' => $user->id,
                'order_code' => $orderCode,
                'package_type' => $package->slug,
                'amount' => $price,
                'total_amount' => $price,
                'payment_status' => 'pending',
                'status' => 'pending',
            ]);

            $order->items()->create([
                'item_type' => 'package',
                'item_id' => $package->id,
                'item_name' => 'Paket: '.$package->name,
                'price' => $price,
                'quantity' => 1,
                'subtotal' => $price,
            ]);

            return $order;
        });
    }

    /**
     * Handle idempotent successful payment callback / confirmation.
     *
     * @param  array<string, mixed>|null  $payload
     */
    public function processSuccessfulPayment(Order $order, string $paymentCode, string $method = 'midtrans', ?array $payload = null): Payment
    {
        return DB::transaction(function () use ($order, $paymentCode, $method, $payload) {
            $orderMetadata = $order->metadata ?? [];
            if ($payload) {
                $orderMetadata['midtrans_response'] = $payload;
            }

            $order->update([
                'status' => 'paid',
                'payment_status' => 'paid',
                'payment_method' => $method,
                'metadata' => $orderMetadata,
                'paid_at' => now(),
            ]);

            $paymentStatus = $payload['transaction_status'] ?? 'paid';

            $payment = Payment::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'payment_code' => $paymentCode,
                ],
                [
                    'amount' => $order->total_amount !== null ? $order->total_amount : $order->amount,
                    'method' => $method,
                    'status' => $paymentStatus,
                    'payload' => $payload,
                    'paid_at' => now(),
                ]
            );

            if ($order->coupon) {
                $order->coupon->increment('used_count');
            }

            // Fulfill purchased items idempotently
            foreach ($order->items as $item) {
                if ($item->item_type === 'theme') {
                    $theme = Theme::find($item->item_id);
                    if ($theme && $order->user) {
                        $this->themeOwnershipService->unlockThemeForUser($order->user, $theme, $order);
                    }
                } elseif ($item->item_type === 'package') {
                    $package = Package::find($item->item_id);
                    if ($package && $order->user) {
                        $order->user->update(['package_id' => $package->id]);
                    }
                }
            }

            return $payment;
        });
    }
}
