<?php
namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Shiur;
use App\Models\Speaker;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class AdminController extends Controller
{
    public function index()
    {
        // Return view for admin dashboard
        return view('admin.dashboard');
    }
    public function createShiur()
    {
        // Retrieve all speakers to populate the dropdown
        $speakers = Speaker::all();

        // Retrieve all series to populate the series dropdown
        $series = Series::all();

        // Pass the speakers and series to the view
        return view('admin.shiur.create', compact('speakers', 'series'));
    }



    public function storeShiur(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'series_id' => 'required|exists:series,id',
            'recording' => 'nullable|file|mimes:mp3,wav|max:1024000000',
            'shiur_date' => 'required|date',
            'price' => 'required|numeric|min:0', // Validate the price
        ]);

        $shiur = new Shiur();
        $shiur->title = $validated['title'];
        $shiur->description = $validated['description'] ?? null;
        $shiur->series_id = $validated['series_id'];
        $shiur->shiur_date = $validated['shiur_date'];
        $shiur->price = $validated['price']; // Set the price

        if ($request->hasFile('recording')) {
            $filePath = $request->file('recording')->store('recordings', 'public');
            $shiur->recording_path = $filePath;
        }

        $shiur->save();

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
            'price' => 'required|numeric|min:0',  // Validate the price input
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
            'price' => $validated['price'], // Save the price
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

    //fetch series is for creating shiur page - to populate series dropdown from selected speaker
    public function fetchSeries(Request $request)
    {
        $speakerId = $request->input('speaker_id');
        if ($speakerId) {
            $series = Series::where('speaker_id', $speakerId)->get();
            return response()->json(['series' => $series]);
        }
        return response()->json(['series' => []]);
    }

    public function showShiurStats()
    {
        // Retrieve all Shiurim to populate the dropdown
        $shiurim = Shiur::all();

        return view('admin.shiurStats', compact('shiurim'));
    }

    public function getShiurStats($shiur_id)
    {
        // Ensure shiur_id is an integer
        $shiur_id = (int) $shiur_id;

        // Get the shiur to find its series_id
        $shiur = Shiur::findOrFail($shiur_id);
        $series_id = $shiur->series_id;

        // Fetch all purchases made directly for this shiur
        $shiurPurchases = DB::table('purchases')
            ->join('users', 'purchases.user_id', '=', 'users.id')
            ->where('purchases.shiur_id', $shiur_id)
            ->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"), 'purchases.created_at')
            ->get()
            ->map(function($purchase) {
                $purchase->created_at = Carbon::parse($purchase->created_at)->format('F j, Y g:i A');
                return $purchase;
            });

        // Fetch all purchases for the series that this shiur belongs to
        $seriesPurchases = DB::table('purchases')
            ->join('users', 'purchases.user_id', '=', 'users.id')
            ->where('purchases.series_id', $series_id)
            ->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"), 'purchases.created_at')
            ->get()
            ->map(function($purchase) {
                $purchase->created_at = Carbon::parse($purchase->created_at)->format('F j, Y g:i A');
                return $purchase;
            });

        // Merge both purchases (shiur-specific and series-wide)
        $purchases = $shiurPurchases->merge($seriesPurchases);

        return response()->json($purchases);
    }

    public function editShiur()
    {
        // Retrieve recently created Shiurs
        $shiurs = Shiur::latest()->get(); // Adjust query as needed
        return view('admin.shiur.edit', compact('shiurs'));
    }

    public function editShiurForm($id)
    {
        $shiur = Shiur::findOrFail($id);
        return view('admin.shiur.editForm', compact('shiur'));
    }
    public function updateShiur(Request $request, $id)
    {
        $shiur = Shiur::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'recording' => 'nullable|file|mimes:mp3,wav|max:1024000000',
            'shiur_date' => 'required|date',
        ]);

        $shiur->title = $validated['title'];
        $shiur->description = $validated['description'] ?? null;
        $shiur->shiur_date = $validated['shiur_date'];

        // Only update the recording if it's uploaded
        if ($request->hasFile('recording')) {
            $filePath = $request->file('recording')->store('recordings', 'public');
            $shiur->recording_path = $filePath;
        }

        $shiur->save();

        return redirect()->route('admin.dashboard')->with('success', 'Shiur updated successfully.');
    }



    public function showMessages()
    {
        $messages = Message::all();
        return view('admin.messages', compact('messages'));
    }

    public function editSeries()
    {
        // Retrieve all series for the edit view
        $series = Series::all();
        return view('admin.series.edit', compact('series'));
    }

    public function editSeriesForm($id)
    {
        $series = Series::findOrFail($id);
        $speakers = Speaker::all(); // For the speaker dropdown
        return view('admin.series.editForm', compact('series', 'speakers'));
    }

    public function updateSeries(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'series_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'speaker_id' => 'required|exists:speakers,id',
            'zoom_link' => 'nullable|string|max:255',
            'zoom_id' => 'nullable|string|max:255',
            'zoom_password' => 'nullable|string|max:255',
        ]);

        // Find the series to update
        $series = Series::findOrFail($id);

        // Handle the file upload
        if ($request->hasFile('series_image')) {
            $imagePath = $request->file('series_image')->store('series_images', 'public');
            $series->image_path = $imagePath; // Update the image path
        }

        // Update other fields
        $series->title = $validated['title'];
        $series->description = $validated['description'];
        $series->speaker_id = $validated['speaker_id'];
        $series->zoom_link = $validated['zoom_link'];
        $series->zoom_id = $validated['zoom_id'];
        $series->zoom_password = $validated['zoom_password'];

        $series->save(); // Save changes

        return redirect()->route('admin.series.edit', $id)->with('success', 'Series updated successfully.');
    }

}
