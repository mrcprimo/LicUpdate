<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $response = Http::get("http://api.weatherstack.com/current", [
                'access_key' => 'ZGXCYVYQ44P8YTYQ28V3C56VG',
                'query' => 'Licab, Nueva Ecija',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $precip = $data['current']['precip'] ?? 0;

                // ✅ Conditional logic
                if ($precip > 0) {
                    Log::info("It's currently raining in Licab. Precipitation: {$precip} mm");
                } else {
                    Log::info("No rain in Licab at the moment.");
                }

                // ✅ You can also save to DB, notify, etc.
                // WeatherData::create([...]);
            } else {
                Log::error("Failed to fetch weather data");
            }
        })->everyMinute();
    }


    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
