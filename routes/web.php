<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'monitors' => \App\Models\Monitor::all(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/monitors', [\App\Http\Controllers\MonitorController::class, 'index'])->name('monitors.index');
    Route::get('/monitors/create', [\App\Http\Controllers\MonitorController::class, 'create'])->name('monitors.create');
    Route::post('/monitors', [\App\Http\Controllers\MonitorController::class, 'store'])->name('monitors.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
