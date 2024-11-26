<?php


namespace App\Services;

use GuzzleHttp\Client;

class ZoomService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => env('ZOOM_BASE_URL', 'https://zoom.us/v2')]);
    }

    public function getAccessToken()
    {
        $response = $this->client->post('https://zoom.us/oauth/token', [
            'auth' => [env('ZOOM_CLIENT_ID'), env('ZOOM_CLIENT_SECRET')],
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => env('ZOOM_ACCOUNT_ID'),
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['access_token'];
    }

    public function createMeeting($topic, $startTime, $duration, $timezone, $password)
    {
        $accessToken = $this->getAccessToken();

        try {
            $response = $this->client->post('users/me/meetings', [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'topic' => $topic,
                    'type' => 2,
                    'start_time' => $startTime,
                    'duration' => $duration,
                    'timezone' => $timezone,
                    'password' => $password,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error('Zoom API Error: ' . $e->getResponse()->getBody()->getContents());
            throw $e;
        }
    }
}
