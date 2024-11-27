<?php
namespace App\Http\Controllers;

use App\Models\Speaker;

class AboutController extends Controller{

    public function showSpeakers()
    {
        $speakers = Speaker::all(); // Assuming Speaker is your model
        return view('navbar.speakers', compact('speakers'));
    }

}
