<?php

// use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::call(function () {
    $response = Http::get("http://api.weatherstack.com/current", [
        'access_key' => '4fe4d4c552a4b275c730f5247fbc12dd',
        'query' => 'Licab, Nueva Ecija',
    ]);

    if ($response->successful()) {
        $data = $response->json();
        $precip = $data['current']['precip'] ?? 0;

        if ($precip > 0) {
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

