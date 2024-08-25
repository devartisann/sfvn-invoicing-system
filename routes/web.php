<?php

use App\Http\Controllers\FruitCategoryController;
use App\Http\Controllers\FruitController;
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

Route::middleware('auth')->group(function(){
    Route::get('fruits', [FruitController::class, 'index'])->name('fruit.index');
    Route::post('fruits', [FruitController::class, 'store'])->name('fruit.store');
    Route::get('fruit/categories', [FruitCategoryController::class, 'index'])->name('fruit.category.index');
    Route::post('fruit/categories', [FruitCategoryController::class, 'store'])->name('fruit.category.store');
});

require __DIR__.'/auth.php';
