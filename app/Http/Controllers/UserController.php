<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Series;

class UserController extends Controller
{
    public function purchases()
    {
        $user = auth()->user();
        // Get the series the user has purchased in, based on the shiur
        $purchasedSeries = Series::whereHas('shiurs.purchases', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['shiurs' => function ($query) use ($user) {
            $query->whereHas('purchases', function ($subQuery) use ($user) {
                $subQuery->where('user_id', $user->id);
            });
        }])->get();

        // Pass the variable to the view
        return view('user.purchasedseries', compact('purchasedSeries'));
    }



    public function showSeries($id)
    {
        $user = auth()->user();
        $series = Series::with(['shiurs' => function ($query) use ($user) {
            $query->whereHas('purchases', function ($subQuery) use ($user) {
                $subQuery->where('user_id', $user->id);
            });
        }])->findOrFail($id);

        // Update the view name here
        return view('user.purchasedshiurs', compact('series'));
    }


}
