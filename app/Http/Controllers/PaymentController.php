<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Shiur;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;

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
            'success_url' => route('payments.success', ['shiurId' => $shiur->id]),
            'cancel_url' => route('payments.cancel'),
        ]);

        return redirect($session->url);
    }

    // Payment success
    public function paymentSuccess($shiurId)
    {
        // Retrieve the Shiur that was purchased
        $shiur = Shiur::findOrFail($shiurId);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Save the purchase in the purchases table
        Purchase::create([
            'user_id' => $userId,
            'shiur_id' => $shiur->id,
            'amount' => $shiur->price, // Assuming the amount is from the Shiur price
        ]);

        return view('payments.success');
    }


    // Payment canceled
    public function paymentCancel()
    {
        return view('payments.cancel');
    }
}
