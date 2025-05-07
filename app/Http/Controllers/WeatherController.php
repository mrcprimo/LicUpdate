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

    public function storeWeatherHistory($desc, $precip, $warning, $date)
    {
        $response = Http::post($this->baseUrl() . 'Weather_history.json', [
            'description' => $desc,
            'precipitation' => $precip,
            'warning'=> $warning,
            'created_at'=> $date
        ]);

        if($response){
            return true;
        }
    }

    public function storeUserContact()
    {
        $response = Http::post($this->baseUrl() . 'Users.json', [
            'email' => request()->get('emailuser'),
        ]);

        if($response){
            return true;
        }
    }

    public function latest_threshold()
    {

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
