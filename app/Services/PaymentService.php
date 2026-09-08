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
     * Create a purchase order for a theme with duration and service options.
     */
    public function createOrderForTheme(User $user, Theme $theme, string $duration = '45_days', string $serviceType = 'self_service'): Order
    {
        return DB::transaction(function () use ($user, $theme, $duration, $serviceType) {
            $durationPrice = $duration === 'lifetime' ? $theme->getLifetimePrice() : $theme->getPrice45Days();
            $assistedFee = $serviceType === 'assisted' ? $theme->getAssistedFee() : 0.00;
            $totalBaseAmount = $durationPrice + $assistedFee;

            $taxRate = 0.11;
            $taxAmount = round($totalBaseAmount * $taxRate);
            $totalAmount = $totalBaseAmount + $taxAmount;

            $durationLabel = $duration === 'lifetime' ? 'Lifetime (Selamanya)' : '45 Hari';
            $serviceLabel = $serviceType === 'assisted' ? 'Diisikan Tim (+Fee)' : 'Isi Data Mandiri';

            $orderCode = 'ORD-THM-'.strtoupper(Str::random(8));

            $order = Order::create([
                'user_id' => $user->id,
                'order_code' => $orderCode,
                'package_type' => 'single_template',
                'amount' => $totalBaseAmount,
                'discount' => 0.00,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
                'payment_status' => 'pending',
                'status' => 'pending',
                'metadata' => [
                    'duration' => $duration,
                    'duration_days' => $duration === 'lifetime' ? null : 45,
                    'duration_label' => $durationLabel,
                    'service_type' => $serviceType,
                    'service_label' => $serviceLabel,
                    'theme_price' => $durationPrice,
                    'assisted_fee' => $assistedFee,
                    'tax_rate' => 0.11,
                    'tax_amount' => $taxAmount,
                ],
            ]);

            $order->items()->create([
                'item_type' => 'theme',
                'item_id' => $theme->id,
                'item_name' => 'Template: '.$theme->name,
                'price' => $durationPrice,
                'quantity' => 1,
                'subtotal' => $durationPrice,
            ]);

            if ($serviceType === 'assisted' && $assistedFee > 0) {
                $order->items()->create([
                    'item_type' => 'service',
                    'item_id' => $theme->id,
                    'item_name' => 'Layanan Tambahan: Bantu Pengisian Data oleh Tim',
                    'price' => $assistedFee,
                    'quantity' => 1,
                    'subtotal' => $assistedFee,
                ]);
            }

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
            $taxRate = 0.11;
            $taxAmount = round($price * $taxRate);
            $totalAmount = $price + $taxAmount;
            $orderCode = 'ORD-PKG-'.strtoupper(Str::random(8));

            $order = Order::create([
                'user_id' => $user->id,
                'order_code' => $orderCode,
                'package_type' => $package->slug,
                'amount' => $price,
                'discount' => 0.00,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
                'payment_status' => 'pending',
                'status' => 'pending',
                'metadata' => [
                    'tax_rate' => 0.11,
                    'tax_amount' => $taxAmount,
                ],
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
