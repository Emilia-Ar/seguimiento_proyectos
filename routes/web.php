<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Proyectos;
use App\Livewire\Tareas;
use App\Livewire\Entregas;

// Ruta principal (página de bienvenida)
Route::view('/', 'welcome');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Ruta del dashboard (requiere verificación de email)
    Route::view('/dashboard', 'dashboard')
        ->middleware('verified')
        ->name('dashboard');

    // Rutas con componentes Livewire
    Route::get('/proyectos', Proyectos::class)->name('proyectos.index');
    Route::get('/tareas', Tareas::class)->name('tareas.index');
    Route::get('/entregas', Entregas::class)->name('entregas.index');

    // Vistas de perfil (ambas por compatibilidad)
    Route::view('/perfil', 'perfil')->name('perfil');
    Route::view('/profile', 'profile')->name('profile');
});

// Rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';

