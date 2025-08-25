<?php

// #####################################################################
// Archivo 1: routes/api.php
// #####################################################################
//
// Coloca todas estas rutas en tu archivo routes/api.php.
// Cada ruta corresponde a una función del panel de control.

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdseCloudController;
use App\Http\Controllers\GeminiChatController;

Route::post('gemini-chat', [GeminiChatController::class, 'handleChat']);

// Agrupamos todas las rutas bajo un prefijo para mantener el orden.
Route::prefix('idse')->group(function () {
    Route::post('/carga-certificado', [IdseCloudController::class, 'cargaCertificado']);
    Route::post('/consulta-historial', [IdseCloudController::class, 'consultaHistorial']);
    Route::post('/consulta-acuse', [IdseCloudController::class, 'consultaAcuse']);
    Route::post('/consulta-emisiones', [IdseCloudController::class, 'consultaEmisiones']);
    Route::post('/envio-movimientos', [IdseCloudController::class, 'envioMovimientos']);
    Route::post('/consulta-programados', [IdseCloudController::class, 'consultaProgramados']);
    Route::post('/eliminar-programado', [IdseCloudController::class, 'eliminarProgramado']);
    Route::post('/check-health', [IdseCloudController::class, 'checkHealth']);
    Route::post('/trabajadores-activos', [IdseCloudController::class, 'trabajadoresActivos']);
});
