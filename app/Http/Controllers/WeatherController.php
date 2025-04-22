<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    protected $firebaseUrl = 'https://licupdate-6a3fb-default-rtdb.asia-southeast1.firebasedatabase.app/';

    protected function baseUrl()
    {
        return rtrim($this->firebaseUrl, '/') . '/';
    }

    public function store()
    {
        $response = Http::post($this->baseUrl() . 'Weather_history.json', [
            'title' => 'Hello Firebase',
            'body' => 'This is synced from Laravel!',
        ]);

        return response()->json($response->json());
    }

    public function latest_threshold()
    {
        // Firebase REST API doesn't support complex queries easily,
        // but we can fetch all and get the last one manually.
        $response = Http::get($this->baseUrl() . 'Weather_history.json');

        $data = $response->json();

        if (!$data) return response()->json(null);

        // Get the latest item by key (assuming they're time-ordered)
        $latest = end($data);

        return response()->json($latest);
    }

    public function index()
    {
        $response = Http::get($this->baseUrl() . 'Weather_history.json');

        return response()->json($response->json());
    }
}
