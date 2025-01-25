<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayersViewController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
})->name('index');

Route::get('/teams', function () {
    return view('teams');
})->name('teams.view');

Route::get('/news', function () {
    return view('news');
})->name('news.view');

Route::get('/players', [PlayersViewController::class, 'index'])->name('players.view');
Route::get('/player/{playerId}', [PlayersViewController::class, 'show'])->name('player.view');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
