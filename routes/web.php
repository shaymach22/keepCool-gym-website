<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Coaches - public viewing
Route::get('/coaches', [CoachController::class, 'index']);

// Events - public viewing
Route::get('/events', [EventController::class, 'index']);

// Offres - public viewing
Route::get('/offres', function () {
    return view('offres');
});

// Playlist - public viewing
Route::get('/playlist', [PlaylistController::class, 'index']);

// Admin only - manage coaches
Route::middleware('admin')->group(function () {
    Route::get('/coaches/create', [CoachController::class, 'create']);
    Route::post('/coaches', [CoachController::class, 'store']);
    Route::get('/coaches/{coach}/edit', [CoachController::class, 'edit']);
    Route::put('/coaches/{coach}', [CoachController::class, 'update']);
    Route::delete('/coaches/{coach}', [CoachController::class, 'destroy']);

    // Admin only - manage events
    Route::get('/events/create', [EventController::class, 'create']);
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events/{event}/edit', [EventController::class, 'edit']);
    Route::put('/events/{event}', [EventController::class, 'update']);
    Route::delete('/events/{event}', [EventController::class, 'destroy']);
});

// Inscription - requires login
Route::get('/inscription', function () {
    return view('inscription');
})->middleware('auth');

Route::post('/inscription', [RegistrationController::class, 'store'])->middleware('auth');

// Book a coach - shown to under-15 registrants
Route::get('/book-coach', function () {
    return view('book-coach');
});

// Subscriptions - requires login
Route::post('/subscribe', [SubscriptionController::class, 'store'])->middleware('auth');

// Playlist - suggesting/voting/deleting requires login
Route::post('/playlist', [PlaylistController::class, 'store'])->middleware('auth');
Route::post('/playlist/{song}/vote', [PlaylistController::class, 'vote'])->middleware('auth');
Route::delete('/playlist/{song}', [PlaylistController::class, 'destroy'])->middleware('auth');

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::delete('/coaches/{coach}/photo', [CoachController::class, 'removePhoto']);
require __DIR__.'/auth.php';