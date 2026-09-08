<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\MidtransService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService,
        protected MidtransService $midtransService,
    ) {}

    /**
     * Handle payment notification webhook idempotently.
     */
    public function handle(Request $request): JsonResponse
    {
        if ($request->isMethod('GET')) {
            return response()->json([
                'status' => 'ok',
                'service' => 'Midtrans Payment Webhook Receiver',
                'timestamp' => now()->toIso8601String(),
            ]);
        }

        $orderCode = $request->input('order_id') ?? $request->input('order_code');
        $transactionStatus = $request->input('transaction_status') ?? $request->input('status');
        $paymentType = $request->input('payment_type') ?? $request->input('method') ?? 'midtrans';

        if (! $orderCode) {
            return response()->json(['status' => 'ok', 'message' => 'Webhook endpoint is active and listening'], 200);
        }

        /** @var Order|null $order */
        $order = Order::where('order_code', $orderCode)
            ->orWhere('uuid', $orderCode)
            ->first();

        if (! $order) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Notification ping acknowledged (Order not found in database)',
            ], 200);
        }

        // Verify signature if provided by Midtrans
        $signatureKey = $request->input('signature_key');
        $statusCode = (string) $request->input('status_code');
        $grossAmount = (string) $request->input('gross_amount');

        if (! empty($signatureKey) && $this->midtransService->isConfigured()) {
            if (! $this->midtransService->verifySignature((string) $orderCode, $statusCode, $grossAmount, (string) $signatureKey)) {
                return response()->json(['status' => 'error', 'message' => 'Invalid signature key'], 403);
            }
        }

        // If already paid, return idempotent success
        if ($order->isPaid()) {
            return response()->json(['status' => 'success', 'message' => 'Order was already processed']);
        }

        $fraudStatus = $request->input('fraud_status');

        $isSuccess = false;
        if ($transactionStatus === 'capture') {
            // For credit card transaction, capture requires fraud_status accept
            $isSuccess = ($fraudStatus === 'accept' || empty($fraudStatus));
        } elseif (in_array($transactionStatus, ['settlement', 'paid', 'success'], true)) {
            $isSuccess = true;
        }

        // Process successful payment
        if ($isSuccess) {
            $paymentCode = $request->input('transaction_id') ?? 'WH-'.time();
            $this->paymentService->processSuccessfulPayment(
                $order,
                $paymentCode,
                $paymentType,
                $request->all()
            );

            return response()->json(['status' => 'success', 'message' => 'Payment processed successfully']);
        }

        if ($transactionStatus === 'pending') {
            $orderMetadata = $order->metadata ?? [];
            $orderMetadata['midtrans_pending'] = $request->all();

            $order->update([
                'payment_method' => $paymentType,
                'metadata' => $orderMetadata,
            ]);

            Payment::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'payment_code' => $request->input('transaction_id') ?? 'PND-'.time(),
                ],
                [
                    'amount' => $order->total_amount !== null ? $order->total_amount : $order->amount,
                    'method' => $paymentType,
                    'status' => 'pending',
                    'payload' => $request->all(),
                ]
            );

            return response()->json(['status' => 'success', 'message' => 'Pending payment recorded']);
        }

        if (in_array($transactionStatus, ['cancel', 'deny', 'expire', 'failed'], true)) {
            $orderMetadata = $order->metadata ?? [];
            $orderMetadata['midtrans_failed'] = $request->all();

            $order->update([
                'status' => 'failed',
                'payment_status' => 'failed',
                'metadata' => $orderMetadata,
            ]);

            Payment::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'payment_code' => $request->input('transaction_id') ?? 'FAIL-'.time(),
                ],
                [
                    'amount' => $order->total_amount !== null ? $order->total_amount : $order->amount,
                    'method' => $paymentType,
                    'status' => (string) $transactionStatus,
                    'payload' => $request->all(),
                ]
            );

            return response()->json(['status' => 'success', 'message' => 'Order marked as failed']);
        }

        if (in_array($transactionStatus, ['refund', 'partial_refund', 'chargeback'], true)) {
            $orderMetadata = $order->metadata ?? [];
            $orderMetadata['midtrans_refund'] = $request->all();

            $order->update([
                'status' => 'refunded',
                'payment_status' => 'refunded',
                'metadata' => $orderMetadata,
            ]);

            Payment::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'payment_code' => $request->input('transaction_id') ?? 'REF-'.time(),
                ],
                [
                    'amount' => $order->total_amount !== null ? $order->total_amount : $order->amount,
                    'method' => $paymentType,
                    'status' => (string) $transactionStatus,
                    'payload' => $request->all(),
                ]
            );

            return response()->json(['status' => 'success', 'message' => 'Order marked as refunded']);
        }

        return response()->json(['status' => 'ignored', 'message' => 'Status acknowledged']);
    }
}
