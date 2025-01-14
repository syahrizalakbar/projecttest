<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SparePartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/sparepart')->middleware(['auth', 'verified'])->name('sparepart.')->group(function () {
    Route::get('/', [SparePartController::class, 'index'])->name('index');
    Route::get('/create', [SparePartController::class, 'create'])->name('create');
    Route::get('/search', [SparePartController::class, 'search'])->name('search');
    Route::get('/{id}/show', [SparePartController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [SparePartController::class, 'edit'])->name('edit');

    Route::post('/', [SparePartController::class, 'store'])->name('store');
    Route::patch('/{id}', [SparePartController::class, 'update'])->name('update');
    Route::delete('/{id}', [SparePartController::class, 'destroy'])->name('destroy');
});

Route::get('/report', [ReportController::class, 'index'])->middleware(['auth', 'verified'])->name('report');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
