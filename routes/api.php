<?php
use App\Http\Controllers\API\ProyectoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('proyectos', ProyectoController::class);
});