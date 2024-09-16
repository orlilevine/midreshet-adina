<?php
namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Shiur;
use App\Models\Speaker;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Return view for admin dashboard
        return view('admin.dashboard');
    }
    public function createShiur()
    {
        // Retrieve all series to populate the dropdown
        $series = Series::all();

        // Pass the series to the view
        return view('admin.shiur.create', compact('series'));
    }


    public function storeShiur(Request $request)
    {
        // Validate the form data, including the files
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'series_id' => 'required|exists:series,id',
            'recording' => 'nullable|file|mimes:mp3,wav|max:1024000000', // max size in KB (100MB)
            'shiur_date' => 'required|date',
            'series_image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validate image file
        ]);

        // Create the Shiur
        $shiur = new Shiur();
        $shiur->title = $validated['title'];
        $shiur->description = $validated['description'] ?? null;
        $shiur->series_id = $validated['series_id'];
        $shiur->shiur_date = $validated['shiur_date']; // Store the date

        // Handle the recording file upload
        if ($request->hasFile('recording')) {
            $filePath = $request->file('recording')->store('recordings', 'public');
            $shiur->recording_path = $filePath;
        }

        // Handle the series image upload
        if ($request->hasFile('series_image')) {
            $imagePath = $request->file('series_image')->store('series_images', 'public');
            $shiur->series->image_path = $imagePath; // Assuming series image is saved in the `series` table
            $shiur->series->save(); // Save the updated series with the new image path
        }

        // Save the Shiur
        $shiur->save();

        // Redirect to the appropriate page
        return redirect()->route('admin.dashboard')->with('success', 'Shiur created successfully.');
    }

    public function createSeries()
    {
        $speakers = Speaker::all();
        return view('admin.series.create', compact('speakers'));
    }

    public function storeSeries(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'series_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'speaker_id' => 'required|exists:speakers,id',
            'zoom_link' => 'nullable|string',
            'zoom_id' => 'nullable|string',
            'zoom_password' => 'nullable|string',
        ]);

        // Handle the file upload
        $imagePath = null;
        if ($request->hasFile('series_image')) {
            try {
                $imagePath = $request->file('series_image')->store('series_images', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['series_image' => 'Image upload failed.']);
            }
        }

        // Create the series
        Series::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'speaker_id' => $validated['speaker_id'],
            'zoom_link' => $validated['zoom_link'],
            'zoom_id' => $validated['zoom_id'],
            'zoom_password' => $validated['zoom_password'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Series created successfully.');
    }


    public function createSpeaker()
    {
        return view('admin.speaker.create');
    }

    public function storeSpeaker(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'salutation' => 'nullable|string|max:50',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max size as needed
        ]);

        $speaker = new Speaker();
        $speaker->salutation = $validated['salutation'] ?? null;
        $speaker->first_name = $validated['first_name'];
        $speaker->last_name = $validated['last_name'];
        $speaker->bio = $validated['bio'] ?? null;

        // Handle the image file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('speaker_images', 'public');
            $speaker->image_path = $imagePath;
        }

        $speaker->save();

        return redirect()->route('admin.dashboard')->with('success', 'Speaker created successfully.');
    }
}
