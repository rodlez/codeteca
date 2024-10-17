<?php

// Controllers
use App\Http\Controllers\Code\CodeTypeController;
use App\Http\Controllers\ProfileController;

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
});

// TYPE
Route::get('/dashboard/type', [CodeTypeController::class, 'index'])->name('codetype.index')->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
