<?php

use App\Http\Controllers\Api\TareaController;
use App\Http\Controllers\Api\EntregaController;
use App\Http\Controllers\Api\ProyectoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;

// Ruta para emitir tokens (debe estar afuera del grupo auth)
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = App\Models\User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }

    return response()->json(['token' => $user->createToken('api-token')->plainTextToken]);
});

// Rutas protegidas con auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('proyectos', ProyectoController::class);
    Route::apiResource('tareas', TareaController::class);
    Route::apiResource('entregas', EntregaController::class);
});
