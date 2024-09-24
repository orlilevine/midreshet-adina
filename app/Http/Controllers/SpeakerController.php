<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function showSpeaker($speakerId)
    {
        // Get the speaker details
        $speaker = Speaker::findOrFail($speakerId);

        // Get series related to the speaker
        $series = Series::where('speaker_id', $speakerId)->get();

        return view('speakers/show', compact('speaker', 'series'));
    }
}
