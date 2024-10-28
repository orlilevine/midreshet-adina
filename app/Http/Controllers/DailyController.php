<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Series;

class DailyController extends Controller
{

    public function joinDailyMeeting(Request $request, $id)
    {
        \Log::info("Joining daily meeting for series ID: {$id}");

        $series = Series::findOrFail($id);
        $startTime = \Carbon\Carbon::parse($series->starting_time);

        // Clone $startTime to preserve the original value
        $allowedStartTime = (clone $startTime)->subMinutes(15);
        $allowedEndTime = (clone $startTime)->addHours(2);

        \Log::info("Allowed start time: {$allowedStartTime} to {$allowedEndTime}");
        \Log::info("Current time: " . now());

        if (now()->between($allowedStartTime, $allowedEndTime)) {
            $dailyLink = urldecode($request->query('url'));
            return view('Daily.daily_meeting', ['dailyLink' => $dailyLink]);
        } else {
            return redirect()->back()->with('error', 'You can only join the meeting 15 minutes before the class until 2 hours after it starts.');
        }
    }

}
