<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Shiur;
use Illuminate\Http\Request;
class PurchaseController extends Controller
{
    public function create($shiur_id)
    {
        $shiur = Shiur::findOrFail($shiur_id);

        // Handle payment logic here
        // ...

        // After successful payment, store the purchase record
        $purchase = new Purchase();
        $purchase->user_id = auth()->id(); // Assuming the user is authenticated
        $purchase->shiur_id = $shiur_id;
        $purchase->amount = $shiur->price;
        $purchase->save();

        return redirect()->back()->with('success', 'Shiur purchased successfully!');
    }
    public function store(Request $request, Shiur $shiur)
    {
        $purchase = Purchase::create([
            'user_id' => auth()->id(),
            'shiur_id' => $shiur->id,
            'amount' => $shiur->price,
        ]);

        // Send the Zoom link via email or show it on the confirmation page
        // ...

        return redirect()->route('shiurs.index')->with('success', 'Shiur purchased successfully! Check your email for the Zoom link.');
    }
}
