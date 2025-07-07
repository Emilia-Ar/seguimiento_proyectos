<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('registro', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('registro', [RegisteredUserController::class, 'store']);
    Route::get('inicio-sesion', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('inicio-sesion', [AuthenticatedSessionController::class, 'store']);
    Route::get('olvide-contrasena', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');
    Route::post('olvide-contrasena', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');
    Route::get('restablecer-contrasena/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');
    Route::post('restablecer-contrasena', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verificar-correo', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');
    Route::get('verificar-correo/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
    Route::post('notificacion-verificacion-correo', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');
    Route::get('confirmar-contrasena', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');
    Route::post('confirmar-contrasena', [ConfirmablePasswordController::class, 'store']);
    Route::post('cerrar-sesion', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});