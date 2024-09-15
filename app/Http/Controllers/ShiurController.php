<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;

class ShiurController extends Controller
{
    public function show($id)
    {
        // Find the series by ID
        $series = Series::findOrFail($id);

        // Retrieve all shiurs related to this series
        $shiurs = Shiur::where('series_id', $id)->get();

        // Pass both series and shiurs to the view
        return view('series.show', compact('series', 'shiurs'));
    }




    public function mrsShiraSmiles()
    {
        $series = Series::where('speaker_id', 1)->get();

        return view('shiurs.smiles', compact('series'));
    }


    public function mrsDinaSchoonmaker()
    {
        $series = Series::where('speaker_id', 2)->get();

        return view('shiurs.schoonmaker', compact('series'));    }

    public function rabbiAviSlansky()
    {
        $series = Series::where('speaker_id', 3)->get();

        return view('shiurs.slansky', compact('series'));
    }


}
