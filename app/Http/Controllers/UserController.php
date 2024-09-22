<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Series;

class UserController extends Controller
{
    public function purchases()
    {
        $user = auth()->user();

        // Get the series the user has purchased directly
        $purchasedSeries = Series::whereHas('purchases', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->whereNotNull('series_id'); // Ensures it's a series purchase
        })->orWhereHas('shiurs.purchases', function ($query) use ($user) {
            // Also get series where user has purchased individual shiurs
            $query->where('user_id', $user->id);
        })->get();

        // Pass the variable to the view
        return view('user.purchasedseries', compact('purchasedSeries'));
    }



    public function showSeries($id)
    {
        $user = auth()->user();

        // Check if the user has purchased the entire series
        $hasPurchasedSeries = \App\Models\Purchase::where('user_id', $user->id)
            ->where('series_id', $id)
            ->exists();

        if ($hasPurchasedSeries) {
            // If the user purchased the entire series, retrieve all shiurs in the series
            $series = Series::with('shiurs')->findOrFail($id);
        } else {
            // If the user has only purchased individual shiurs, retrieve only the purchased shiurs
            $series = Series::with(['shiurs' => function ($query) use ($user) {
                $query->whereHas('purchases', function ($subQuery) use ($user) {
                    $subQuery->where('user_id', $user->id);
                });
            }])->findOrFail($id);
        }

        return view('user.purchasedshiurs', compact('series'));
    }

}
