<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TriviaController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\Api\TodayInHistoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/sanctum/token', [AuthController::class, 'createToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

 
    Route::get('weather', [WeatherController::class, 'showWeatherForm'])->name('weather');
    Route::post('weather', [WeatherController::class, 'fetchWeatherData'])->name('weather.fetch');
    Route::get('cats', [CatController::class, 'showCatForm'])->name('cats');
    Route::post('cats', [CatController::class, 'fetchCatImages'])->name('cats.fetch');
    Route::get('trivia', [TriviaController::class, 'showTriviaForm'])->name('trivia');
    Route::post('trivia', [TriviaController::class, 'fetchTriviaQuestions'])->name('trivia.fetch');
});
