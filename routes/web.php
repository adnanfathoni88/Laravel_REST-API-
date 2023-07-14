<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// weather 
Route::get('/weather', 'App\Http\Controllers\WeatherController@getWeatherToday');
