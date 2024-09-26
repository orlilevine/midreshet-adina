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
    public function createCheckoutSessionForShiur(Request $request, $shiurId)
    {
        // Fetch the Shiur
        $shiur = Shiur::findOrFail($shiurId);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Define the coupon if provided
        $discounts = [];
        if ($request->has('coupon_code')) {
            $discounts = [
                [
                    'coupon' => $request->coupon_code,
                ]
            ];
        }

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
            'discounts' => $discounts, // Add discount if available
            'mode' => 'payment',
            'success_url' => route('payments.success', ['shiurId' => $shiur->id]),
            'cancel_url' => route('payments.cancel'),
        ]);

        // Redirect to Stripe payment page
        return redirect($session->url);
    }

    public function createCheckoutSessionForSeries(Request $request, $seriesId)
    {
        // Fetch the Series
        $series = Series::findOrFail($seriesId);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Define the coupon if provided
        $discounts = [];
        if ($request->has('coupon_code')) {
            $discounts = [
                [
                    'coupon' => $request->coupon_code,
                ]
            ];
        }

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
            'discounts' => $discounts, // Add discount if available
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

        return view('payments.success');
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

    public function handleZellePaymentSeries(Request $request)
    {
        $validated = $request->validate([
            'zelle_account_from' => 'required|string|max:255',
            'zelle_amount' => 'required|numeric',
            'zelle_date' => 'required|date',
        ]);

        $series = Series::findOrFail($request->input('series_id'));
        $seriesPrice = $series->price;

        Purchase::create([
            'user_id' => Auth::id(),
            'series_id' => $request->input('series_id'),
            'amount' => $seriesPrice,
            'payment_method' => 'zelle',
            'zelle_account_from' => $validated['zelle_account_from'],
            'zelle_amount' => $validated['zelle_amount'],
            'zelle_date' => $validated['zelle_date'],
        ]);

        return redirect()->back()->with('success', 'Series purchased');
    }

    public function handleCheckPaymentSeries(Request $request)
    {
        $validated = $request->validate([
            'check_name' => 'required|string|max:255',
            'check_amount' => 'required|numeric',
            'check_date' => 'required|date',
        ]);

        $series = Series::findOrFail($request->input('series_id'));
        $seriesPrice = $series->price;

        Purchase::create([
            'user_id' => Auth::id(),
            'series_id' => $request->input('series_id'),
            'amount' => $seriesPrice,
            'payment_method' => 'check',
            'check_name' => $validated['check_name'],
            'check_amount' => $validated['check_amount'],
            'check_date' => $validated['check_date'],
        ]);

        return redirect()->back()->with('success', 'Series purchased');
    }

    public function handleZellePaymentShiur(Request $request)
    {
        // Validate request and assign to $validated
        $validated = $request->validate([
            'shiur_id' => 'required|exists:shiurs,id',
            'zelle_account_from' => 'required|string',
            'zelle_amount' => 'required|numeric',
            'zelle_date' => 'required|date',
        ]);

        $shiur = Shiur::findOrFail($validated['shiur_id']);
        $shiurPrice = $shiur->price;

        // Set the shiur as purchased for the user
        Purchase::create([
            'user_id' => Auth::id(),
            'shiur_id' => $validated['shiur_id'],
            'payment_method' => 'zelle',
            'amount' => $shiurPrice,
            'zelle_account_from' => $validated['zelle_account_from'],
            'zelle_amount' => $validated['zelle_amount'],
            'zelle_date' => $validated['zelle_date'],
        ]);

        return redirect()->back()->with('success', 'Shiur purchased');
    }

    public function handleCheckPaymentShiur(Request $request)
    {
        // Validate request and assign to $validated
        $validated = $request->validate([
            'shiur_id' => 'required|exists:shiurs,id',
            'check_name' => 'required|string',
            'check_amount' => 'required|numeric',
            'check_date' => 'required|date',
        ]);

        $shiur = Shiur::findOrFail($validated['shiur_id']);
        $shiurPrice = $shiur->price;

        Purchase::create([
            'user_id' => Auth::id(),
            'shiur_id' => $validated['shiur_id'],
            'amount' => $shiurPrice,
            'payment_method' => 'check',
            'check_name' => $validated['check_name'],
            'check_amount' => $validated['check_amount'],
            'check_date' => $validated['check_date'],
        ]);

        return redirect()->back()->with('success', 'Shiur purchased');
    }

}
