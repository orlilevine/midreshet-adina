<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Shiur;

class PaymentController extends Controller
{
    // Create Checkout Session
    public function createCheckoutSession($shiurId)
    {
        $shiur = Shiur::findOrFail($shiurId);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $shiur->title,
                    ],
                    'unit_amount' => $shiur->price * 100, // amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payments.success'),
            'cancel_url' => route('payments.cancel'),
        ]);

        return redirect($session->url);
    }

    // Payment success
    public function paymentSuccess()
    {
        return view('payments.success');
    }

    // Payment canceled
    public function paymentCancel()
    {
        return view('payments.cancel');
    }
}
