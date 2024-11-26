<?php
namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Shiur;
use App\Models\Speaker;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;



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
        // Validate inputs
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'series_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'speaker_id' => 'required|exists:speakers,id',
            'price' => 'required|numeric|min:0',
            'shiur_time' => 'required',
            'shiur_date_1' => 'nullable|date',
            'shiur_date_2' => 'nullable|date',
            'shiur_date_3' => 'nullable|date',
            'shiur_date_4' => 'nullable|date',
            'shiur_date_5' => 'nullable|date',
            'shiur_date_6' => 'nullable|date',
            'shiur_date_7' => 'nullable|date',
            'shiur_date_8' => 'nullable|date',
        ]);

        // Handle image upload if necessary
        $imagePath = $request->hasFile('series_image')
            ? $request->file('series_image')->store('series_images', 'public')
            : null;

        // Get Zoom access token
        $zoomController = new ZoomController();
        $accessToken = $zoomController->getZoomAccessToken();

        // Format the start time to UTC ISO 8601 format
        $startTime = \Carbon\Carbon::parse($validated['shiur_date_1'] . ' ' . $validated['shiur_time'])->toISOString();

        // Generate a random passcode
        $passcode = bin2hex(random_bytes(4)); // Generates an 8-character alphanumeric passcode

        // Call Zoom API to create a meeting
        $response = Http::withToken($accessToken)->post(env('ZOOM_BASE_URL') . '/users/me/meetings', [
            'topic' => $validated['title'],
            'type' => 2, // Scheduled meeting
            'start_time' => $startTime,
            'duration' => 120,
            'password' => '123456',
            'settings' => [
                'join_before_host' => true,
                'mute_upon_entry' => true,
                'waiting_room' => false,
                'approval_type' => 2, // Automatically approve participants
                'auto_recording' => 'none', // Disable auto-recording for everyone
                'recording_privileges' => 'host', // Ensure only the host can record
            ],
        ]);

        // Check if Zoom API call was successful
        if ($response->failed()) {
            \Log::error('Zoom meeting creation failed: ' . $response->body());
            return redirect()->back()->withErrors(['message' => 'Failed to create Zoom meeting: ' . $response->body()]);
        }

        // Retrieve Zoom meeting details
        $zoomMeeting = $response->json();

        // NEW: Log meeting details to verify settings
        $meetingDetails = Http::withToken($accessToken)->get(env('ZOOM_BASE_URL') . "/meetings/{$zoomMeeting['id']}");
        \Log::info('Meeting Details: ' . $meetingDetails->body());

        // Format the start time to a valid datetime format (Y-m-d H:i:s)
        $startTime = \Carbon\Carbon::parse($validated['shiur_date_1'] . ' ' . $validated['shiur_time'])->format('Y-m-d H:i:s');

        // Create the series record
        $series = Series::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'speaker_id' => $validated['speaker_id'],
            'zoom_link' => $zoomMeeting['join_url'],
            'zoom_password' => '123456', // Save the generated passcode
            'price' => $validated['price'],
            'starting_time' => $startTime, // Use the properly formatted datetime
            'shiur_date_1' => $validated['shiur_date_1'],
            'shiur_date_2' => $validated['shiur_date_2'],
            'shiur_date_3' => $validated['shiur_date_3'],
            'shiur_date_4' => $validated['shiur_date_4'],
            'shiur_date_5' => $validated['shiur_date_5'],
            'shiur_date_6' => $validated['shiur_date_6'],
            'shiur_date_7' => $validated['shiur_date_7'],
            'shiur_date_8' => $validated['shiur_date_8'],
        ]);

        // Insert purchase record for speaker
        $speaker = Speaker::find($validated['speaker_id']);
        $speakerUserId = $speaker->user_id;

        DB::table('purchases')->insert([
            'user_id' => $speakerUserId,
            'series_id' => $series->id,
            'amount' => $series->price,
            'payment_method' => 'speaker',
            'created_at' => now(),
            'updated_at' => now(),
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
        $shiur_id = (int)$shiur_id;

        // Get the shiur to find its series_id
        $shiur = Shiur::findOrFail($shiur_id);
        $series_id = $shiur->series_id;

        // Fetch all purchases made directly for this shiur
        $shiurPurchases = DB::table('purchases')
            ->join('users', 'purchases.user_id', '=', 'users.id')
            ->where('purchases.shiur_id', $shiur_id)
            ->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"), 'purchases.created_at')
            ->get()
            ->map(function ($purchase) {
                $purchase->created_at = Carbon::parse($purchase->created_at)->format('F j, Y g:i A');
                return $purchase;
            });

        // Fetch all purchases for the series that this shiur belongs to
        $seriesPurchases = DB::table('purchases')
            ->join('users', 'purchases.user_id', '=', 'users.id')
            ->where('purchases.series_id', $series_id)
            ->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"), 'purchases.created_at')
            ->get()
            ->map(function ($purchase) {
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
            'shiur_time' => 'required|date_format:H:i', // Validate time format
            'price' => 'required|numeric|min:0',
            // Add validation for shiur dates if needed
            'shiur_date_1' => 'nullable|date',
            'shiur_date_2' => 'nullable|date',
            'shiur_date_3' => 'nullable|date',
            'shiur_date_4' => 'nullable|date',
            'shiur_date_5' => 'nullable|date',
            'shiur_date_6' => 'nullable|date',
            'shiur_date_7' => 'nullable|date',
            'shiur_date_8' => 'nullable|date',
        ]);

        // Find the series to update
        $series = Series::findOrFail($id);

        // Handle the file upload
        if ($request->hasFile('series_image')) {
            $imagePath = $request->file('series_image')->store('series_images', 'public');
            $series->image_path = $imagePath;
        }

        // Update fields
        $series->title = $validated['title'];
        $series->description = $validated['description'];
        $series->speaker_id = $validated['speaker_id'];
        $series->starting_time = $validated['shiur_time'];
        $series->price = $validated['price'];

        // Update shiur dates
        for ($i = 1; $i <= 8; $i++) {
            $dateField = 'shiur_date_' . $i;
            $series->$dateField = $request->input($dateField);
        }

        $series->save(); // Save changes

        return redirect()->route('admin.series.edit', $id)->with('success', 'Series updated successfully.');
    }
}
