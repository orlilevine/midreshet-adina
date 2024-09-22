<?php

namespace App\Http\Controllers;

use App\Models\HomepageSlide;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {
        $slides = HomepageSlide::all(); // Fetch all slides from the database
        return view('home', compact('slides')); // Pass the slides to the view
    }

}

