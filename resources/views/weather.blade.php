@extends('layout.layout')

@section('title', 'Weather')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-4 col-12">
            @include('shared.left-sidebar')
        </div>
        <div class="col-lg-6 col-md-8 col-12">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h1>Weather Information</h1>
                        <form action="{{ route('weather.fetch') }}" method="POST" class="form-inline">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="Enter City" required>
                                <button class="btn btn-primary" type="submit">Get Weather</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (isset($weatherData))
                    <div class="mt-5">
                        <h2>Weather in {{ $city }}</h2>
                        <p><strong>Temperature:</strong> {{ $weatherData['main']['temp'] }} °C</p>
                        <p><strong>Weather:</strong> {{ $weatherData['weather'][0]['description'] }}</p>
                        <p><strong>Humidity:</strong> {{ $weatherData['main']['humidity'] }}%</p>
                        <p><strong>Wind Speed:</strong> {{ $weatherData['wind']['speed'] }} m/s</p>
                    </div>
                @elseif(isset($error))
                    <div class="mt-4 alert alert-danger">
                        {{ $error }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
