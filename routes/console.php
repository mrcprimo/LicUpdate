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
        'access_key' => '5a0736a61e0852b247d9bbc135dfc167',
        'query' => 'Licab, Nueva Ecija',
    ]);

    if ($response->successful()) {
        $data = $response->json();
        $precip = $data['current']['precip'] ?? 0;

        // ✅ Call the latest_threshold function
        $controller = app(WeatherController::class);
        $latest = $controller->latest_threshold();
        
        $precipitation = $latest[0]['precipitation'];

        $red = $precipitation;
        $orange = ($precipitation * 75)/100; // 75% of threshold
        $yellow = ($precipitation * 50)/100; // 50% of threshold

        if ($precip > 0) {
            if($precip >= $red){
                Mail::to('primomarcangelo@gmail.com')->send(new WarningMail('red', $precip));
            }
            else if($precip >= $orange && $precip < $red){
                Mail::to('primomarcangelo@gmail.com')->send(new WarningMail('orange', $precip));
            }
            else if($precip >= $yellow && $precip < $orange){
                Mail::to('primomarcangelo@gmail.com')->send(new WarningMail('yellow', $precip));
            }
            
            Log::info("🌧️ It's currently raining in Licab. Precipitation: {$precip} mm");
        } else {
            Log::info("☀️ No rain in Licab at the moment.");
        }
    } else {
        Log::error("⚠️ Failed to fetch weather data");
    }
})->everyMinute();


Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

