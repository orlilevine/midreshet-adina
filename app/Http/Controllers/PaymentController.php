<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Shiur;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Models\Series;

class PaymentController extends Controller
{
    public function createCheckoutSessionForShiur($shiurId)
    {
        // Fetch the Shiur
        $shiur = Shiur::findOrFail($shiurId);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create Stripe checkout session for a Shiur
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

        // Redirect to Stripe payment page
        return redirect($session->url);
    }
    public function createCheckoutSessionForSeries($seriesId)
    {
        // Fetch the Series
        $series = Series::findOrFail($seriesId);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create Stripe checkout session for a Series
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $series->title,
                    ],
                    'unit_amount' => $series->price * 100, // amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payments.success.series', ['seriesId' => $series->id]),
            'cancel_url' => route('payments.cancel'),
        ]);

        // Redirect to Stripe payment page
        return redirect($session->url);
    }


// New method for series purchase success
    public function paymentSuccessSeries($seriesId)
    {
        // Retrieve the Series that was purchased
        $series = Series::findOrFail($seriesId);
        $userId = Auth::id();

        // Save the purchase in the purchases table
        Purchase::create([
            'user_id' => $userId,
            'series_id' => $series->id, // Save series ID
            'amount' => $series->price, // Assuming the amount is from the Series price
            'shiur_id' => null, // No specific shiur for series purchase
        ]);

        return view('payments.success'); // You might want to customize this view
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
