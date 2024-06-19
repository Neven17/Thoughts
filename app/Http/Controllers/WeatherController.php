<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function showWeatherForm()
    {
        return view('weather');
    }

    public function fetchWeatherData(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:15',
        ]);

        $city = $request->input('city');
        $apiKey = env('OPENWEATHER_API_KEY');
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $weatherData = $response->json();
            return view('weather', ['weatherData' => $weatherData, 'city' => $city]);
        } else {
            return view('weather', ['error' => 'Unable to fetch weather data for the specified city.']);
        }
    }
}
