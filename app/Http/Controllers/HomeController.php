<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;

class HomeController extends Controller
{

    public function index()
    {
        $featuredSeries = Series::where('is_featured', true)->get();

        return view('Home', compact('featuredSeries'));
    }


}

