<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Speaker;
use Illuminate\Http\Request;


class SpeakerController extends Controller
{
    public function mrsShiraSmiles()
    {
        $series = Series::where('speaker_id', 1)->get();

        return view('speakers.smiles', compact('series'));
    }


    public function mrsDinaSchoonmaker()
    {
        $series = Series::where('speaker_id', 2)->get();
        return view('speakers.schoonmaker', compact('series'));
    }

    public function rabbiAviSlansky()
    {
        $series = Series::where('speaker_id', 3)->get();

        return view('speakers.slansky', compact('series'));
    }


}
