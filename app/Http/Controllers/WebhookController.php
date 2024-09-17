<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;

class WebhookController extends Controller
{
public function handle(Request $request)
{
// You can verify the webhook event and handle the event here
$event = Webhook::constructEvent(
$request->getContent(),
$request->header('Stripe-Signature'),
env('STRIPE_WEBHOOK_SECRET')
);

switch ($event->type) {
case 'payment_intent.succeeded':
// Handle successful payment
break;
case 'payment_intent.payment_failed':
// Handle payment failure
break;
}

return response()->json(['status' => 'success']);
}
}
