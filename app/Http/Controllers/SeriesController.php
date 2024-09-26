<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Shiur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;

class SeriesController extends Controller
{

    public function showSeries($id)
    {
        // Find the series and related shiurs
        $series = Series::with('speaker')->findOrFail($id);
        $shiurs = Shiur::where('series_id', $id)->get();

        // Check if the user has already purchased this series
        $user = Auth::user();
        $hasPurchasedSeries = false;

        if ($user) {
            $hasPurchasedSeries = Purchase::where('user_id', $user->id)
                ->where('series_id', $id)
                ->exists();
        }

        return view('series.show', compact('series', 'shiurs', 'hasPurchasedSeries'));
    }

}
