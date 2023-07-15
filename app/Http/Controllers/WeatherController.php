<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    function getWeatherIcon($icon)
    {
        switch ($icon) {
            case '01d':
                return 'wi wi-day-sunny';
            case '01n':
                return 'wi wi-night-clear';
            case '02d':
                return 'wi wi-day-cloudy';
            case '02n':
                return 'wi wi-night-alt-cloudy';
            case '03d':
            case '03n':
                return 'wi wi-cloud';
            case '04d':
            case '04n':
                return 'wi wi-cloudy';
            case '09d':
            case '09n':
                return 'wi wi-showers';
            case '10d':
                return 'wi wi-day-rain';
            case '10n':
                return 'wi wi-night-alt-rain';
            case '11d':
            case '11n':
                return 'wi wi-thunderstorm';
            case '13d':
            case '13n':
                return 'wi wi-snow';
            case '50d':
            case '50n':
                return 'wi wi-fog';
            default:
                return 'wi wi-na';
        }
    }

    function  getWeatherToday(Request $request)
    {
        $city = $request->city;

        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=7acd355ade48c3380e09512df01c6847";

        $response = file_get_contents($url);
        $data = json_decode($response);


        if ($data->cod == 200) {
            $existingWeather = Weather::where('city', $city)->first();

            if ($existingWeather) {
                $existingWeather->temperature = $data->main->temp;
                $existingWeather->humidity = $data->main->humidity;
                $existingWeather->save();
            } else {
                Weather::create([
                    'city' => $city,
                    'temperature' => $data->main->temp,
                    'humidity' => $data->main->humidity,
                ]);
            }
        }

        $weather = Weather::where('city', $city)->get(); // get all data from database
        $icon = $this->getWeatherIcon($data->weather[0]->icon); // get icon from function

        return view('temp/index', compact('weather', 'icon'));
    }
}
