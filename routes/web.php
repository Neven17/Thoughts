<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlocksController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TriviaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ThoughtController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowBoxController;
use App\Http\Controllers\Lang\LangController;
use App\Http\Controllers\ThoughtLikeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminThoughtController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;  //Dodali smo zbog sukoba istih imena 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

//Dohvat svih
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('search-users',[SearchController::class, 'searchUser'])->middleware('auth')->name('search.users');

Route::get('search-content', [SearchController::class, 'searchContent'])->middleware('auth')->name('search.content');


//Resources smo dodali da  ne moramo imati ono edit, destroy...
Route::resource('thoughts', ThoughtController::class)->except(['index', 'create', 'show'])->middleware('auth');   //Automatski stvara sve metode a u ovome mu kazemo da zanemari ove rute

Route::resource('thoughts', ThoughtController::class)->only(['show']);   //Ovdje ce napraviti samo za show posto ona mora biti dostupna

Route::resource('thoughts.comments', CommentController::class)->only(['store'])->middleware('auth');   //komentiranje kontroler ima samo show pa zato ima only


Route::resource('users', UserController::class)->only('show');         //Ovo je za usere i profile da osiguramo koje ce moci operacije koristiti i pobrinuti se da su ulogirani

Route::resource('users', UserController::class)->only(['show', 'edit', 'update', 'destroy'])->middleware('auth');         //Ovo je za usere i profile da osiguramo koje ce moci operacije koristiti i pobrinuti se da su ulogirani


Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile'); //Kada stisne na left-sidebar viwe profil da mu se otvori ili gore ime sto je profil da mu otvori

Route::get('all-users', [UserController::class, 'allUsers'])->middleware('auth')->name('all.users');  //Kada stisne na left-sidebar viwe profil da mu se otvori ili gore ime sto je profil da mu otvori

Route::get('terms', [UserController::class, 'terms'])->middleware('auth')->name('terms');

Route::get('all-followers', [UserController::class, 'showFollowers'])->middleware('auth')->name('all.followers');


//Ep28- Follow i unfollow
Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');   //users pa od users id pa follow

Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');


//BLOCK I UNBLOCK
Route::post('users/{user}/block', [BlocksController::class, 'block'])->middleware('auth')->name('users.block');   //users pa od users id pa block

Route::post('users/{user}/unblock', [BlocksController::class, 'unblock'])->middleware('auth')->name('users.unblock');





//Ep33- Like
Route::post('thoughts/{thought}/like', [ThoughtLikeController::class, 'like'])->middleware('auth')->name('thoughts.like');   //users pa od users id pa follow

Route::post('thoughts/{thought}/unlike', [ThoughtLikeController::class, 'unlike'])->middleware('auth')->name('thoughts.unlike');





//ep 43 dynamic localizator
Route::get('lang/{lang}',[LangController::class, 'lang'])->name('lang');


//ep49 Admin user page
Route::middleware(['auth', 'can:admin'])->prefix('/admin')->as('admin.')->group(function()   {

    //ADMIN PAGE 37
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard'); //can iz authservice provider   i Admin smo definirali gore skroz kao as

    //za user
    Route::resource('users', AdminUserController::class)->only('index'); 
  
    //za thought
    Route::resource('thoughts', AdminThoughtController::class)->only('index'); 

   //za comments
    Route::resource('comments', AdminCommentController::class)->only('index', 'destroy'); 

});



