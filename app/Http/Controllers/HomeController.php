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
        $nextShiur = $this->getNextShiurTime();

        return view('Home', compact('featuredSeries', 'eventDate', 'nextShiur'));
    }

    public function getNextShiurTime()
    {
        $series = \DB::table('series')->get();
        $now = now();

        $nextShiur = null;

        foreach ($series as $s) {
            for ($i = 1; $i <= 8; $i++) {
                $shiurDateColumn = 'shiur_date_' . $i;
                $shiurDate = $s->$shiurDateColumn;

                if ($shiurDate) {
                    // Extract the time from the full starting time
                    $startingTime = \Carbon\Carbon::parse($s->starting_time)->format('H:i:s');

                    // Combine the date and extracted time
                    $shiurDateTimeString = $shiurDate . ' ' . $startingTime;

                    try {
                        // Create a valid Carbon instance
                        $shiurDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shiurDateTimeString);

                        // Check if the time is in the future and if it is the next upcoming shiur
                        if ($shiurDateTime->isFuture() && (!$nextShiur || $shiurDateTime->lt($nextShiur))) {
                            $nextShiur = $shiurDateTime;
                        }
                    } catch (\Exception $e) {
                        // Log the error if the format is invalid
                        \Log::error('Error creating Carbon instance for: ' . $shiurDateTimeString . ' with error: ' . $e->getMessage());
                    }
                }
            }
        }
        // Log the next Shiur
        if ($nextShiur) {
            \Log::debug('Next Shiur: ' . $nextShiur->toDateTimeString());
        } else {
            \Log::debug('No upcoming Shiur found.');
        }

        return $nextShiur;
    }

}

