<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;

class HomeController extends Controller
{

    public function index() {
        $featuredSeries = Series::where('is_featured', true)->get();
        $eventDate = '2024-11-03 09:15:00';
        ['nextShiur' => $nextShiur, 'nextShiurSpeaker' => $nextShiurSpeaker] = $this->getNextShiurTime();

        return view('Home', compact('featuredSeries', 'eventDate', 'nextShiur', 'nextShiurSpeaker'));
    }


    public function getNextShiurTime()
    {
        // Get all series
        $series = \DB::table('series')->get();
        $now = now();

        $nextShiur = null;
        $nextShiurSpeaker = null;  // Variable to hold the speaker's name

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

        return compact('nextShiur', 'nextShiurSpeaker');
    }

}

