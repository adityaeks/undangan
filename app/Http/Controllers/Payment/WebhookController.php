<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService,
    ) {}

    /**
     * Handle payment notification webhook idempotently.
     */
    public function handle(Request $request): JsonResponse
    {
        $orderCode = $request->input('order_id') ?? $request->input('order_code');
        $transactionStatus = $request->input('transaction_status') ?? $request->input('status');
        $paymentType = $request->input('payment_type') ?? $request->input('method') ?? 'midtrans';

        if (! $orderCode) {
            return response()->json(['status' => 'error', 'message' => 'Order code is required'], 400);
        }

        /** @var Order|null $order */
        $order = Order::where('order_code', $orderCode)->first();

        if (! $order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        // If already paid, return idempotent success
        if ($order->isPaid()) {
            return response()->json(['status' => 'success', 'message' => 'Order was already processed']);
        }

        // Process successful payment
        if (in_array($transactionStatus, ['capture', 'settlement', 'paid', 'success'], true)) {
            $paymentCode = $request->input('transaction_id') ?? 'WH-'.time();
            $this->paymentService->processSuccessfulPayment(
                $order,
                $paymentCode,
                $paymentType,
                $request->all()
            );

            return response()->json(['status' => 'success', 'message' => 'Payment processed successfully']);
        }

        if (in_array($transactionStatus, ['cancel', 'deny', 'expire', 'failed'], true)) {
            $order->update(['status' => 'failed', 'payment_status' => 'failed']);

            return response()->json(['status' => 'success', 'message' => 'Order marked as failed']);
        }

        return response()->json(['status' => 'ignored', 'message' => 'Status acknowledged']);
    }
}
