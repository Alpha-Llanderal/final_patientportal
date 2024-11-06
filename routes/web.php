<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Auth\RegisterController;

// Landing page
Route::get('/', function () {
    return view('landing');
});

// Authentication Routes
Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/privacy-policy', function () {
    return view('privacy_policy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::post('/profile/update', [ProfileController::class, 'updateProfile']);
    Route::post('/profile/address', [ProfileController::class, 'addAddress']);
    Route::delete('/profile/address/{id}', [ProfileController::class, 'deleteAddress']);
    Route::post('/profile/phone', [ProfileController::class, 'addPhone']);
    Route::delete('/profile/phone/{id}', [ProfileController::class, 'deletePhone']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
