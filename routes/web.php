<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TareaController;
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

    // Rutas para Proyectos
    Route::resource('proyectos', ProyectoController::class)->names('proyectos');

    // Rutas para Tareas
    Route::resource('tareas', TareaController::class)->names('tareas');

    // Ruta para Perfiles
    Route::get('/perfiles', function () {
        return view('perfiles');
    })->name('perfiles');

    // Ruta para Gestión con Livewire
    Route::get('/gestion-proyectos', \App\Livewire\GestionProyectos::class)->name('gestion-proyectos');
});

require __DIR__.'/auth.php';