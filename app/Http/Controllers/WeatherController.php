<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getCurrentWeather()
    {
        $accessKey = 'ZGXCYVYQ44P8YTYQ28V3C56VG';
        $location = 'Licab, Nueva Ecija';

        $response = Http::get("http://api.weatherstack.com/current", [
            'access_key' => $accessKey,
            'query' => $location,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            $description = $data['current']['weather_descriptions'][0] ?? '';
            $precip = $data['current']['precip'] ?? 0;

            return response()->json([
                'description' => $description,
                'precip' => $precip,
            ]);
        } else {
            return response()->json(['error' => 'API request failed'], 500);
        }
    }
}
