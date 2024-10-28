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
        $shiurDates = [
            $series->shiur_date_1,
            $series->shiur_date_2,
            $series->shiur_date_3,
            $series->shiur_date_4,
            $series->shiur_date_5,
            $series->shiur_date_6,
            $series->shiur_date_7,
            $series->shiur_date_8,
        ];

        $shiurTime = \Carbon\Carbon::parse($series->starting_time);

        // Create an array to hold allowed time ranges
        $allowedTimes = [];

        foreach ($shiurDates as $date) {
            if ($date) { // Ensure the date is not null
                $shiurDateTime = \Carbon\Carbon::parse($date)->setTimeFromTimeString($shiurTime->toTimeString());
                $allowedStartTime = (clone $shiurDateTime)->subMinutes(15);
                $allowedEndTime = (clone $shiurDateTime)->addHours(2);
                $allowedTimes[] = [$allowedStartTime, $allowedEndTime];
            }
        }

        $currentDateTime = now();
        $canJoin = false;

        // Check if current time is within any allowed time range
        foreach ($allowedTimes as [$start, $end]) {
            if ($currentDateTime->between($start, $end)) {
                $canJoin = true;
                break;
            }
        }

        \Log::info("Current time: " . $currentDateTime);
        \Log::info("Allowed time ranges: " . json_encode($allowedTimes));

        if ($canJoin) {
            $dailyLink = urldecode($request->query('url'));
            return view('Daily.daily_meeting', ['dailyLink' => $dailyLink]);
        } else {
            return redirect()->back()->with('error', 'You can only join the meeting 15 minutes before the class.');
        }
    }

}
