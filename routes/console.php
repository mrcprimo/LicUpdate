<?php

// use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule::call(function () {
//     $response = Http::get("http://api.weatherstack.com/current", [
//         'access_key' => 'ZGXCYVYQ44P8YTYQ28V3C56VG',
//         'query' => 'Licab, Nueva Ecija',
//     ]);

//     if ($response->successful()) {
//         $data = $response->json();
//         $precip = $data['current']['precip'] ?? 0;

//         // ✅ Conditional logic
//         if ($precip > 0) {
//             Log::info("It's currently raining in Licab. Precipitation: {$precip} mm");
//         } else {
//             Log::info("No rain in Licab at the moment.");
//         }

//         // ✅ You can also save to DB, notify, etc.
//         // WeatherData::create([...]);
//     } else {
//         Log::error("Failed to fetch weather data");
//     }
// })->everyMinute();
