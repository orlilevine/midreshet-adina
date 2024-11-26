<?php
namespace App\Http\Controllers;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use App\Models\Series;
use Illuminate\Support\Facades\Log;
class TwilioController extends Controller
{
    public function joinLiveShiur($id)
    {
        $series = Series::findOrFail($id);
        $roomName = $series->daily_link;

        // Log environment variables to check if they are being accessed
        Log::info('TWILIO_ACCOUNT_SID: ' . env('TWILIO_ACCOUNT_SID'));
        Log::info('TWILIO_API_KEY: ' . env('TWILIO_API_KEY'));
        Log::info('TWILIO_API_SECRET: ' . env('TWILIO_API_SECRET'));

        // Check if the environment variables are being read
        if (empty(env('TWILIO_ACCOUNT_SID')) || empty(env('TWILIO_API_KEY')) || empty(env('TWILIO_API_SECRET'))) {
            Log::error('Twilio environment variables are not set properly');
        }

        $token = new AccessToken(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_API_KEY'),
            env('TWILIO_API_SECRET'),
            3600
        );

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);
        $token->addGrant($videoGrant);

        Log::info('Generated Access Token: ' . $token->toJWT());


        return view('Twilio.live-shiur', [
            'roomName' => $roomName,
            'accessToken' => $token->toJWT(),
        ]);
    }

    public function startRecording($roomName)
    {
        $twilio = new Client(env('TWILIO_API_KEY'), env('TWILIO_API_SECRET'), env('TWILIO_ACCOUNT_SID'));

        try {
            $recording = $twilio->video->v1->rooms($roomName)->recordings->create();
            return response()->json(['message' => 'Recording started successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
