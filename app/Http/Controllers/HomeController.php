<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    public function index()
    {
        // Fetch series where the current date is between shiur_date_1 and shiur_date_8
        $currentSeries = Series::whereDate('shiur_date_1', '<=', now())
            ->whereDate('shiur_date_8', '>=', now())
            ->get();

        $eventDate = '2024-11-03 09:15:00';
        ['nextShiur' => $nextShiur, 'nextShiurSpeaker' => $nextShiurSpeaker, 'nextShiurTitle' => $nextShiurTitle, 'nextShiurDescription' => $nextShiurDescription] = $this->getNextShiurTime();

        return view('home', compact('currentSeries', 'eventDate', 'nextShiur', 'nextShiurSpeaker', 'nextShiurTitle', 'nextShiurDescription'));
    }



    public function getNextShiurTime()
    {
        // Get all series
        $series = \DB::table('series')->get();
        $now = now();

        $nextShiur = null;
        $nextShiurSpeaker = null;
        $nextShiurTitle = null;
        $nextShiurDescription = null;

        foreach ($series as $s) {
            for ($i = 1; $i <= 8; $i++) {
                $shiurDateColumn = 'shiur_date_' . $i;
                $shiurDate = $s->$shiurDateColumn;

                if ($shiurDate) {
                    $startingTime = \Carbon\Carbon::parse($s->starting_time)->format('H:i:s');
                    $shiurDateTimeString = $shiurDate . ' ' . $startingTime;

                    try {
                        $shiurDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shiurDateTimeString);

                        if ($shiurDateTime->isFuture() && (!$nextShiur || $shiurDateTime->lt($nextShiur))) {
                            $nextShiur = $shiurDateTime;

                            // Fetch the speaker information using speaker_id
                            $speaker = \DB::table('speakers')->where('id', $s->speaker_id)->first();

                            if ($speaker) {
                                // Construct the full name of the speaker
                                $nextShiurSpeaker = $speaker->salutation . ' ' . $speaker->first_name . ' ' . $speaker->last_name;
                            } else {
                                $nextShiurSpeaker = 'Speaker Name';  // Fallback in case speaker info is missing
                            }

                            // Get the title and description of the series
                            $nextShiurTitle = $s->title;
                            $nextShiurDescription = $s->description;
                        }
                    } catch (\Exception $e) {
                        \Log::error('Error creating Carbon instance for: ' . $shiurDateTimeString . ' with error: ' . $e->getMessage());
                    }
                }
            }
        }

        if ($nextShiur) {
            \Log::debug('Next Shiur: ' . $nextShiur->toDateTimeString() . ' by ' . $nextShiurSpeaker);
        } else {
            \Log::debug('No upcoming Shiur found.');
        }

        return compact('nextShiur', 'nextShiurSpeaker', 'nextShiurTitle', 'nextShiurDescription');
    }
}

