<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    protected string $serverKey;

    protected string $clientKey;

    protected bool $isProduction;

    protected bool $isSanitized;

    protected bool $is3ds;

    public function __construct()
    {
        $this->serverKey = (string) config('services.midtrans.server_key', '');
        $this->clientKey = (string) config('services.midtrans.client_key', '');
        $this->isProduction = (bool) config('services.midtrans.is_production', false);
        $this->isSanitized = (bool) config('services.midtrans.is_sanitized', true);
        $this->is3ds = (bool) config('services.midtrans.is_3ds', true);
    }

    /**
     * Check if Midtrans server key and client key are configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->serverKey) && ! empty($this->clientKey);
    }

    /**
     * Get Midtrans Client Key for frontend Snap SDK.
     */
    public function getClientKey(): string
    {
        return $this->clientKey;
    }

    /**
     * Get Midtrans Snap JS URL based on environment.
     */
    public function getSnapJsUrl(): string
    {
        return $this->isProduction
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    }

    /**
     * Get Midtrans Snap API URL based on environment.
     */
    public function getSnapApiUrl(): string
    {
        return $this->isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    }

    /**
     * Generate or retrieve existing Snap Token for an Order.
     */
    public function getSnapToken(Order $order): ?string
    {
        if ($order->isPaid() || $order->isExpired()) {
            return null;
        }

        // Return cached token if already generated and still valid
        if (! empty($order->snap_token)) {
            return $order->snap_token;
        }

        if (! $this->isConfigured()) {
            return null;
        }

        $grossAmount = (int) round($order->total_amount !== null ? (float) $order->total_amount : (float) $order->amount);

        // Build item details
        $itemDetails = [];
        $calculatedSum = 0;

        foreach ($order->items as $item) {
            $itemPrice = (int) round((float) $item->price);
            $itemQty = (int) $item->quantity;
            $calculatedSum += ($itemPrice * $itemQty);

            $itemDetails[] = [
                'id' => (string) $item->id,
                'price' => $itemPrice,
                'quantity' => $itemQty,
                'name' => mb_strimwidth($item->item_name, 0, 50, '...'),
            ];
        }

        if ((float) $order->discount > 0) {
            $discountAmount = (int) round((float) $order->discount);
            $calculatedSum -= $discountAmount;

            $itemDetails[] = [
                'id' => 'DISCOUNT-'.($order->coupon?->code ?? 'PROMO'),
                'price' => -1 * $discountAmount,
                'quantity' => 1,
                'name' => 'Diskon Kupon '.($order->coupon?->code ?? ''),
            ];
        }

        if ((float) $order->tax_amount > 0) {
            $taxAmount = (int) round((float) $order->tax_amount);
            $calculatedSum += $taxAmount;

            $itemDetails[] = [
                'id' => 'TAX-PPN-11',
                'price' => $taxAmount,
                'quantity' => 1,
                'name' => 'PPN 11%',
            ];
        }

        // Safety fallback: if items sum doesn't match gross_amount exactly, fallback to single order item
        if ($calculatedSum !== $grossAmount) {
            $itemDetails = [
                [
                    'id' => $order->order_code,
                    'price' => $grossAmount,
                    'quantity' => 1,
                    'name' => 'Order '.$order->order_code,
                ],
            ];
        }

        $payload = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $order->user?->name ?? 'Pelanggan',
                'email' => $order->user?->email ?? 'customer@example.com',
            ],
            'expiry' => [
                'start_time' => $order->created_at ? $order->created_at->format('Y-m-d H:i:s O') : now()->format('Y-m-d H:i:s O'),
                'unit' => 'hour',
                'duration' => 24,
            ],
            'callbacks' => [
                'finish' => route('orders.success', ['order' => $order]),
            ],
            'credit_card' => [
                'secure' => $this->is3ds,
            ],
        ];

        try {
            $response = Http::withBasicAuth($this->serverKey, '')
                ->acceptJson()
                ->asJson()
                ->timeout(15)
                ->post($this->getSnapApiUrl(), $payload);

            if ($response->successful() && $response->json('token')) {
                $snapToken = (string) $response->json('token');
                $order->update(['snap_token' => $snapToken]);

                return $snapToken;
            }

            Log::warning('Midtrans Snap request returned unhandled status: '.$response->status(), [
                'order' => $order->order_code,
                'response' => $response->json(),
            ]);

            return null;
        } catch (\Throwable $e) {
            Log::error('Midtrans Snap request exception: '.$e->getMessage(), [
                'order' => $order->order_code,
            ]);

            return null;
        }
    }

    /**
     * Verify Midtrans notification signature key.
     */
    public function verifySignature(string $orderId, string $statusCode, string $grossAmount, string $signature): bool
    {
        if (empty($this->serverKey)) {
            return false;
        }

        $expected = hash('sha512', $orderId.$statusCode.$grossAmount.$this->serverKey);

        return hash_equals($expected, $signature);
    }
}
