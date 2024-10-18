<?php

// Controllers
use App\Http\Controllers\Code\CodeCategoryController;
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
Route::get('/dashboard/type/create', [CodeTypeController::class, 'create'])->name('codetype.create')->middleware(['auth', 'verified']);
Route::get('/dashboard/type/{type}', [CodeTypeController::class, 'show'])->name('codetype.show')->middleware(['auth', 'verified']);
Route::put('/dashboard/type/{type}', [CodeTypeController::class, 'update'])->name('codetype.update')->middleware(['auth', 'verified']);
Route::delete('/dashboard/type/{type}', [CodeTypeController::class, 'destroy'])->name('codetype.destroy')->middleware(['auth', 'verified']);
Route::get('/dashboard/type/edit/{type}', [CodeTypeController::class, 'edit'])->name('codetype.edit')->middleware(['auth', 'verified']);

// CATEGORY
Route::get('/dashboard/category', [CodeCategoryController::class, 'index'])->name('codecategory.index')->middleware(['auth', 'verified']);
Route::get('/dashboard/category/create', [CodeCategoryController::class, 'create'])->name('codecategory.create')->middleware(['auth', 'verified']);
Route::get('/dashboard/category/{category}', [CodeCategoryController::class, 'show'])->name('codecategory.show')->middleware(['auth', 'verified']);
Route::put('/dashboard/category/{category}', [CodeCategoryController::class, 'update'])->name('codecategory.update')->middleware(['auth', 'verified']);
Route::delete('/dashboard/category/{category}', [CodeCategoryController::class, 'destroy'])->name('codecategory.destroy')->middleware(['auth', 'verified']);
Route::get('/dashboard/category/edit/{category}', [CodeCategoryController::class, 'edit'])->name('codecategory.edit')->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
