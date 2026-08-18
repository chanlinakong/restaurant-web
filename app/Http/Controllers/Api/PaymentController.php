<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use App\Models\Order;

class PaymentController extends Controller
{

    /**
     * Create Stripe Payment Intent
     */
    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'order_id' => [
                'required',
                'integer',
                'exists:orders,id',
            ],
        ]);

        $order = Order::findOrFail($request->order_id);

        // Make sure this order uses Stripe
        if ($order->payment_method?->value !== 'stripe') {
            return response()->json([
                'success' => false,
                'message' => 'This order is not a Stripe payment.',
            ], 422);
        }

        Stripe::setApiKey(
            config('services.stripe.secret')
        );

        $paymentIntent = PaymentIntent::create([
            // Get the amount from DATABASE
            'amount' => (int) round(
                $order->total_amount * 100
            ),

            'currency' => 'usd',

            'automatic_payment_methods' => [
                'enabled' => true,
            ],

            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);

        return response()->json([
            'success' => true,

            'client_secret' =>
                $paymentIntent->client_secret,

            'payment_intent_id' =>
                $paymentIntent->id,
        ]);
    }

}