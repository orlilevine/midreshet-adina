<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;

class AdminController extends Controller
{
    public function store(Request $request)
    {
// Validate the form data, including the file
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'series_id' => 'required|exists:series,id',
            'recording' => 'nullable|file|mimes:mp3,wav|max:500000',
        ]);

// Create the shiur
        $shiur = new Shiur();
        $shiur->title = $validated['title'];
        $shiur->description = $validated['description'];
        $shiur->series_id = $validated['series_id'];

// Handle the recording file upload
        if ($request->hasFile('recording')) {
// Store the file in the 'recordings' directory in the public storage
            //make sure the shiur doesnt save in db as publoc/recordings, but only as recordings/ otherswise get errors
            $filePath = $request->file('recording')->store('recordings', 'public');
            $shiur->recording_path = $filePath;
        }

// Save the shiur
        $shiur->save();

// Redirect to the appropriate page
        return redirect()->route('admin.shiur.index')->with('success', 'Shiur created successfully.');
    }



}
