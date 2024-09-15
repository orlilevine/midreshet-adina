<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;

class ShiurController extends Controller
{

    public function show($seriesId, $shiurId)
    {
        // Retrieve the series by its ID
        $series = Series::findOrFail($seriesId);

        // Retrieve the shiur by its ID
        $shiur = Shiur::where('id', $shiurId)->where('series_id', $seriesId)->firstOrFail();

        // Return the view with the shiur and series data
        return view('shiurs.show', compact('shiur', 'series'));
    }





}
