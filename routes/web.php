<?php

// Controllers
use App\Http\Controllers\Code\CodeEntryController;
use App\Http\Controllers\Code\CodeFileController;
use App\Http\Controllers\Code\CodeTypeController;
use App\Http\Controllers\Code\CodeCategoryController;
use App\Http\Controllers\Code\CodeTagController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// MAIN
Route::get('/dashboard', [CodeEntryController::class, 'main'])->name('dashboard')->middleware(['auth', 'verified']);

// ENTRIES
Route::get('/dashboard/entry', [CodeEntryController::class, 'index'])->name('codeentry.index')->middleware(['auth', 'verified']);
Route::get('/dashboard/entry/create', [CodeEntryController::class, 'create'])->name('codeentry.create')->middleware(['auth', 'verified']);
Route::get('/dashboard/entry/{entry}', [CodeEntryController::class, 'show'])->name('codeentry.show')->middleware(['auth', 'verified']);
Route::put('/dashboard/entry/{entry}', [CodeEntryController::class, 'update'])->name('codeentry.update')->middleware(['auth', 'verified']);
Route::delete('/dashboard/entry/{entry}', [CodeEntryController::class, 'destroy'])->name('codeentry.destroy')->middleware(['auth', 'verified']);
Route::get('/dashboard/entry/edit/{entry}', [CodeEntryController::class, 'edit'])->name('codeentry.edit')->middleware(['auth', 'verified']);

// FILES
Route::get('/dashboard/entry/{entry}/file', [CodeFileController::class, 'index'])->name('codefile.index')->middleware(['auth', 'verified']);
Route::get('/dashboard/entry/{entry}/file/{file}', [CodeFileController::class, 'download'])->name('codefile.download')->middleware(['auth', 'verified']);
Route::delete('/dashboard/entry/{entry}/file/{file}', [CodeFileController::class, 'destroy'])->name('codefile.destroy')->middleware(['auth', 'verified']);

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

// TAGS
Route::get('/dashboard/tag', [CodeTagController::class, 'index'])->name('codetag.index')->middleware(['auth', 'verified']);
Route::get('/dashboard/tag/create', [CodeTagController::class, 'create'])->name('codetag.create')->middleware(['auth', 'verified']);
Route::get('/dashboard/tag/{tag}', [CodeTagController::class, 'show'])->name('codetag.show')->middleware(['auth', 'verified']);
Route::put('/dashboard/tag/{tag}', [CodeTagController::class, 'update'])->name('codetag.update')->middleware(['auth', 'verified']);
Route::delete('/dashboard/tag/{tag}', [CodeTagController::class, 'destroy'])->name('codetag.destroy')->middleware(['auth', 'verified']);
Route::get('/dashboard/tag/edit/{tag}', [CodeTagController::class, 'edit'])->name('codetag.edit')->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
