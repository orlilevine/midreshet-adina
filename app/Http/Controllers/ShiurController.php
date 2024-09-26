<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class ShiurController extends Controller
{
    public function show($seriesId, $shiurId)
    {
        // Retrieve the series by its ID
        $series = Series::findOrFail($seriesId);

        // Retrieve the shiur by its ID
        $shiur = Shiur::where('id', $shiurId)->where('series_id', $seriesId)->firstOrFail();

        // Retrieve all shiurs in the series, ordered by their `shiur_number_in_series`
        $shiurs = Shiur::where('series_id', $seriesId)
            ->orderBy('shiur_number_in_series')
            ->get();

        // Check if the authenticated user has purchased the specific shiur or the entire series
        $user = Auth::user();
        $hasPurchasedShiur = false;
        $hasPurchasedSeries = false;

        if ($user) {
            $hasPurchasedShiur = Purchase::where('user_id', $user->id)
                ->where('shiur_id', $shiurId)
                ->exists();

            $hasPurchasedSeries = Purchase::where('user_id', $user->id)
                ->where('series_id', $seriesId)
                ->exists();
        }

        // Return the view with the shiur, series, shiurs data, and purchase status
        return view('shiurs.show', compact('shiur', 'series', 'shiurs', 'hasPurchasedShiur', 'hasPurchasedSeries'));
    }
}
