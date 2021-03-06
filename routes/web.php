<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

// HOME
Route::get('/', function () {
    return view('home');
})->name('home');

// LOGIN
Route::get('/login', [LoginController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);

// REGISTER
Route::get('/register', [RegisterController::class, 'index'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// LOGOUT
Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// USER INFORMATION
Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');

// POST
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// POST LIKE / UNLIKE
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])
    ->name('posts.likes')
    ->middleware('auth');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])
    ->name('posts.likes')
    ->middleware('auth');
