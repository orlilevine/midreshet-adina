<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;

class HomeController extends Controller
{

    public function index()
    {
        // Assuming you have a method to get featured series
        $featuredSeries = Series::where('is_featured', true)->get();
        $upcomingSeries = Series::where('is_featured', true)->get();//Change this to upcoming later on

        return view('Home', compact('featuredSeries', 'upcomingSeries'));
    }


}

