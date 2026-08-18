<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;


class PaymentController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        return view('pages.payment.index');
    }

    /**
     * Create Stripe Payment Intent
     */
    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:1'
            ]
        ]);

        Stripe::setApiKey(
            config('services.stripe.secret')
        );

        $paymentIntent = PaymentIntent::create([

            'amount' => intval($request->amount * 100),

            'currency' => 'usd',

            'automatic_payment_methods' => [
                'enabled' => true
            ]

        ]);

        return response()->json([

            'clientSecret' => $paymentIntent->client_secret

        ]);
    }

    public function success(Request $request)
    {
        return view('pages.payment.success');
    }
}