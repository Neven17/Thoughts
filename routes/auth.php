<?php


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {      //-Dodao kako ne bih ako si vec ulogiran i u rl ukucas login ti nece izbaciti
    //Automatski izbaci u home ali mi cemo u authserviceprovider promjeniti putanju

    //Registracija
    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/register', [AuthController::class, 'store']);

    //Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
