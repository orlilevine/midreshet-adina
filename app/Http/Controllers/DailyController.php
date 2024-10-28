<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Series;

class DailyController extends Controller
{

public function joinDailyMeeting(Request $request)
{
    $url = urldecode($request->query('url'));
    return view('Daily.daily_meeting', ['dailyLink' => $url]);
}

}
