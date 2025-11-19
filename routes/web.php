<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\HorarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Citas - Accesible para todos los usuarios autenticados (con rate limiting)
    Route::middleware(['throttle:60,1'])->group(function () {
        Route::resource('citas', CitaController::class)->except(['show']);
    });

    // Horarios - Profesionales y Admin (con rate limiting)
    Route::middleware(['role:admin,profesional', 'throttle:100,1'])->group(function () {
        Route::resource('horarios', HorarioController::class)->except(['show', 'edit', 'update']);
        Route::patch('horarios/{horario}/toggle', [HorarioController::class, 'toggle'])->name('horarios.toggle');
    });

    // Profesionales - Solo Admin (con rate limiting)
    Route::middleware(['role:admin', 'throttle:100,1'])->group(function () {
        Route::resource('profesionales', ProfesionalController::class)->except(['show']);
    });

    // Servicios - Solo Admin (con rate limiting)
    Route::middleware(['role:admin', 'throttle:100,1'])->group(function () {
        Route::resource('servicios', ServicioController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';
