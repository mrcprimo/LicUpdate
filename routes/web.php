<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('index');
});

Route::get('/{page}', [PageController::class, 'show'])
    ->where('page', 'history|precData|about|contact');

Route::get('/weather-update', [WeatherController::class,'getCurrentWeather'])->name('weather.update');