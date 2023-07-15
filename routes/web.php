<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('welcome');
});

// weather 
Route::get('/weather', [WeatherController::class, 'getWeatherToday']);
Route::post('/city', [WeatherController::class, 'getWeatherToday']);
