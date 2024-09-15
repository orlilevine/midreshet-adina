<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Shiur;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function showSeries($id)
    {
        $series = Series::findOrFail($id);
        $shiurs = Shiur::where('series_id', $id)->get();

        return view('series.show', compact('series', 'shiurs'));
    }
}
