<?php

// use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\WeatherController;


use App\Mail\WarningMail;
use Illuminate\Support\Facades\Mail;

Schedule::call(function () {

    $response = Http::get("http://api.weatherstack.com/current", [
        'access_key' => '4fe4d4c552a4b275c730f5247fbc12dd',
        'query' => 'Licab, Nueva Ecija',
    ]);

    if ($response->successful()) {
        $data = $response->json();
        $precip = $data['current']['precip'] ?? 0;

        // ✅ Call the latest_threshold function
        $controller = app(WeatherController::class);
        $latest = $controller->latest_threshold();
        
        $precipitation = $latest[0]['precipitation'];

        $red = $precipitation; // threshold
        $orange = ($precipitation * 75)/100; // 75% of threshold
        $yellow = ($precipitation * 50)/100; // 50% of threshold

        // Check if currently raining
        if ($precip > 0) {

            // Reach threshold
            if($precip >= $red){
                Mail::to('primomarcangelo@gmail.com')->send(new WarningMail('red', $precip));
                $controller = app(WeatherController::class);
                $controller->storeWeatherHistory($data['current']['weather_descriptions'], $precip, 'red', now()->format('Y-m-d H:i:s'));
            }
            // 50% of threshold
            else if($precip >= $orange && $precip < $red){
                Mail::to('primomarcangelo@gmail.com')->send(new WarningMail('orange', $precip));
                $controller = app(WeatherController::class);
                $controller->storeWeatherHistory($data['current']['weather_descriptions'], $precip, 'orange', now()->format('Y-m-d H:i:s'));
            }
            // 25% of threshold
            else if($precip >= $yellow && $precip < $orange){
                Mail::to('primomarcangelo@gmail.com')->send(new WarningMail('yellow', $precip));
                $controller = app(WeatherController::class);
                $controller->storeWeatherHistory($data['current']['weather_descriptions'], $precip, 'yellow', now()->format('Y-m-d H:i:s'));
            }
            
            Log::info("🌧️ It's currently raining in Licab. Precipitation: {$precip} mm");

        } else {
            Log::info("☀️ No rain in Licab at the moment.");
        }
    } else {
        Log::error("⚠️ Failed to fetch weather data");
    }
})->twiceDaily(6, 18); // Run the code every 6AM and 6PM


Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

