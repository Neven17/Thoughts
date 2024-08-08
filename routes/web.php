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
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\ThoughtLikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminThoughtController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; 


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

/**
 * Authentication Routes
 */
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);


 // Dashboard Routes
 
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


 // Search Routes
 
Route::get('search-users', [SearchController::class, 'searchUser'])->middleware('auth')->name('search.users');
Route::get('search-content', [SearchController::class, 'searchContent'])->middleware('auth')->name('search.content');


 // Thoughts Routes

Route::resource('thoughts', ThoughtController::class)->except(['index', 'create', 'show'])->middleware('auth');
Route::resource('thoughts', ThoughtController::class)->only(['show']);
Route::resource('thoughts.comments', CommentController::class)->only(['store'])->middleware('auth');
Route::post('thoughts/{thought}/like', [ThoughtLikeController::class, 'like'])->middleware('auth')->name('thoughts.like');
Route::post('thoughts/{thought}/unlike', [ThoughtLikeController::class, 'unlike'])->middleware('auth')->name('thoughts.unlike');


  //Comments Routes

Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');
Route::post('comments/{comment}/like', [CommentLikeController::class, 'like'])->middleware('auth')->name('comments.like');
Route::post('comments/{comment}/unlike', [CommentLikeController::class, 'unlike'])->middleware('auth')->name('comments.unlike');

//User Routes
Route::resource('users', UserController::class)->only('show');
Route::resource('users', UserController::class)->only(['show', 'edit', 'update', 'destroy'])->middleware('auth');
Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('all-users', [UserController::class, 'allUsers'])->middleware('auth')->name('all.users');
Route::get('terms', [UserController::class, 'terms'])->middleware('auth')->name('terms');
Route::get('all-followers', [UserController::class, 'showFollowers'])->middleware('auth')->name('all.followers');

//User Actions
Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');
Route::post('users/{user}/block', [BlocksController::class, 'block'])->middleware('auth')->name('users.block');
Route::post('users/{user}/unblock', [BlocksController::class, 'unblock'])->middleware('auth')->name('users.unblock');

//Lang routes
Route::get('lang/{lang}', [LangController::class, 'lang'])->name('lang');

//Admin Routes
Route::middleware(['auth', 'can:admin'])->prefix('/admin')->as('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class)->only('index');
    Route::resource('thoughts', AdminThoughtController::class)->only('index');
    Route::resource('comments', AdminCommentController::class)->only('index', 'destroy');
});


 // Notification Routes
 
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
});
Route::get('notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
