<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('index');
});

Route::get('/{page}', [PageController::class, 'show'])
    ->where('page', 'history|precData|about|contact');

Route::get('/get-weather', [WeatherController::class, 'index'])->name('weather.history');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
