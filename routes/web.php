<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ScreenshotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Game Routes
    Route::get('/game', [GameController::class, 'index'])->name('game');
    Route::post('/game/score', [GameController::class, 'saveScore'])->name('game.saveScore');
    Route::post('/game/screenshot', [GameController::class, 'saveScreenshot'])->name('game.saveScreenshot');

    // Ranking Routes
    Route::get('/rankings', [RankingController::class, 'index'])->name('rankings');

    // Gallery Routes
    Route::get('/gallery', [ScreenshotController::class, 'index'])->name('gallery');
    Route::post('/gallery/{id}/like', [ScreenshotController::class, 'toggleLike'])->name('gallery.like');
});


require __DIR__.'/auth.php';
