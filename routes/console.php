<?php

// use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\WarningEmail;


Schedule::call(function () {
    $response = Http::get("http://api.weatherstack.com/current", [
        'access_key' => '4fe4d4c552a4b275c730f5247fbc12dd',
        'query' => 'Licab, Nueva Ecija',
    ]);
    $precip = 150;

    // $threshold = DB::table('weather_history')
    //         ->orderBy('created_at', 'desc')
    //         ->first();

            // $th = $threshold->precipitation;
            $th = 158;
            $yellow = (50/100)*$th;
            $orange = (75/100)*$th;
            $red = $th;

            // if( $precip >= $yellow && $precip < $orange){
            //     //send email yellow warning
            // }else if( $precip >= $orange && $precip < $red){
            //     //send email orange warning
            // }else if( $precip >= $red ){
            //     //send email red warning
            // }

            if ($precip >= $yellow && $precip < $orange) {
                Mail::to('primomarcangelo@gmail.com')->send(new WarningEmail('yellow', $precip));
            } elseif ($precip >= $orange && $precip < $red) {
                Mail::to('primomarcangelo@gmail.com')->send(new WarningEmail('orange', $precip));
            } elseif ($precip >= $red) {
                Mail::to('primomarcangelo@gmail.com')->send(new WarningEmail('red', $precip));
            }

    // if ($response->successful()) {
    //     $data = $response->json();
    //     $precip = $data['current']['precip'] ?? 0;

    //     if ($precip > 0) {
    //         $threshold = DB::table('weather_history')
    //         ->orderBy('created_at', 'desc')
    //         ->first();

    //         $th = $threshold->precipitation;
    //         $yellow = (50/100)*$th;
    //         $orange = (75/100)*$th;
    //         $red = $th;

    //         // if( $precip >= $yellow && $precip < $orange){
    //         //     //send email yellow warning
    //         // }else if( $precip >= $orange && $precip < $red){
    //         //     //send email orange warning
    //         // }else if( $precip >= $red ){
    //         //     //send email red warning
    //         // }

    //         if ($precip >= $yellow && $precip < $orange) {
    //             Mail::to('primomarcangelo@gmail.com')->send(new WarningEmail('yellow', $precip));
    //         } elseif ($precip >= $orange && $precip < $red) {
    //             Mail::to('primomarcangelo@gmail.com')->send(new WarningEmail('orange', $precip));
    //         } elseif ($precip >= $red) {
    //             Mail::to('primomarcangelo@gmail.com')->send(new WarningEmail('red', $precip));
    //         }


    //         Log::info("🌧️ It's currently raining in Licab. Precipitation: {$precip} mm");
    //     } else {
    //         Log::info("☀️ No rain in Licab at the moment.");
    //     }
    // } else {
    //     Log::error("⚠️ Failed to fetch weather data");
    // }
})->everyMinute();


Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

