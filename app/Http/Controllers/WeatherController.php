<?php

namespace App\Http\Controllers;

use App\Models\Weather;

class WeatherController extends Controller
{
    function  getWeatherToday()
    {
        $city = 'sleman';
        $apiKey = config('app.open_weather_api_key');

        // $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=" . $apiKey;
        $url = "https://api.openweathermap.org/data/2.5/weather?q=sleman&appid=7acd355ade48c3380e09512df01c6847";

        $response = file_get_contents($url);
        $data = json_decode($response);

        Weather::create([
            'city' => $city,
            'temperature' => $data->main->temp,
            'humidity' => $data->main->humidity ?? 0,
        ]);

        $weather = Weather::all();
        return view('temp/index', compact('weather'));
    }
}
