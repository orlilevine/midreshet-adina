<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;

class ShiurController extends Controller
{
    public function index()
    {
        $shiurs = Shiur::all();
        return view('shiurs.index', compact('shiurs'));
    }

    public function mrsShiraSmiles()
    {
        return view('shiurs.smiles');
    }

    public function mrsDinaSchoonmaker()
    {
// Assuming 'speaker_id' for Mrs. Dina Schoonmaker is 2 (replace with actual ID)
        $series = Series::where('speaker_id', 2)->get();

        return view('shiurs.schoonmaker', compact('series'));    }

    public function rabbiAviSlansky()
    {
        return view('shiurs.slansky');
    }

    public function showSeries($id)
    {
        $series = Series::findOrFail($id);
        $shiurs = Shiur::where('series_id', $id)->get();

        return view('series.show', compact('series', 'shiurs'));
    }
}
