<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Series;

class ZoomController extends Controller
{

    function getZoomAccessToken()
    {
        $clientId = env('ZOOM_CLIENT_ID');
        $clientSecret = env('ZOOM_CLIENT_SECRET');
        $accountId = env('ZOOM_ACCOUNT_ID');
        $url = 'https://zoom.us/oauth/token';

        $response = Http::asForm()->post($url, [
            'grant_type' => 'account_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'account_id' => $accountId,
        ]);

        return $response->json('access_token');
    }


}
