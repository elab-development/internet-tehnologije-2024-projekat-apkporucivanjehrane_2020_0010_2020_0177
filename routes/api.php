<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RestoranController;
use App\Http\Controllers\Api\ProizvodNaMenijuController;
use App\Http\Controllers\Api\PorudzbinaController;
use App\Http\Controllers\Api\WeatherController;
use App\Http\Controllers\Api\StatistikaController;
use App\Http\Controllers\Api\EksportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Health check ruta
Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'API radi ispravno',
        'timestamp' => now()->toDateTimeString()
    ]);
});

// Autentifikacija rute (public)
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    // Zaštićene auth rute
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

// Public rute (bez autentifikacije)
Route::prefix('public')->group(function () {
    // Kategorije
    Route::get('/kategorije', [CategoryController::class, 'index']);
    Route::get('/kategorije/{category}', [CategoryController::class, 'show']);
    
    // Restorani
    Route::get('/restorani', [RestoranController::class, 'index']);
    Route::get('/restorani/{restoran}', [RestoranController::class, 'show']);
    Route::get('/restorani/{restoran}/meni', [RestoranController::class, 'menu']);
    
    // Proizvodi
    Route::get('/proizvodi', [ProizvodNaMenijuController::class, 'index']);
    Route::get('/proizvodi/{proizvod}', [ProizvodNaMenijuController::class, 'show']);
    
    // Vremenska prognoza (javni web servis)
    Route::get('/vremenska-prognoza', [WeatherController::class, 'getBelgradeWeather']);
});

// Zaštićene rute (samo za autentifikovane korisnike)
Route::middleware('auth:sanctum')->group(function () {
    
    // Porudžbine
    Route::prefix('porudzbine')->group(function () {
        Route::get('/', [PorudzbinaController::class, 'index']);
        Route::post('/', [PorudzbinaController::class, 'store']);
        Route::get('/{porudzbina}', [PorudzbinaController::class, 'show']);
        Route::post('/{porudzbina}/otkazi', [PorudzbinaController::class, 'cancel']);
        Route::patch('/{porudzbina}/status', [PorudzbinaController::class, 'updateStatus']);
    });
    
    // Admin rute (samo za administratore)
    Route::middleware('admin')->prefix('admin')->group(function () {
        // Kategorije
        Route::prefix('kategorije')->group(function () {
            Route::post('/', [CategoryController::class, 'store']);
            Route::put('/{category}', [CategoryController::class, 'update']);
            Route::delete('/{category}', [CategoryController::class, 'destroy']);
        });
        
        // Restorani
        Route::prefix('restorani')->group(function () {
            Route::post('/', [RestoranController::class, 'store']);
            Route::put('/{restoran}', [RestoranController::class, 'update']);
            Route::delete('/{restoran}', [RestoranController::class, 'destroy']);
        });
        
        // Proizvodi
        Route::prefix('proizvodi')->group(function () {
            Route::post('/', [ProizvodNaMenijuController::class, 'store']);
            Route::put('/{proizvod}', [ProizvodNaMenijuController::class, 'update']);
            Route::delete('/{proizvod}', [ProizvodNaMenijuController::class, 'destroy']);
        });
        
        // Eksport (admin)
        Route::get('eksport/sve-porudzbine', [EksportController::class, 'eksportSvePorudzbine']);
        Route::get('eksport/restorani', [EksportController::class, 'eksportRestorane']);
    });
    
    // Statistika
    Route::prefix('statistika')->group(function () {
        Route::get('/moje', [StatistikaController::class, 'mojeStatistike']);
        Route::get('/opsta', [StatistikaController::class, 'opstaStatistika']);
        Route::get('/popularni-restorani', [StatistikaController::class, 'najpopularnijiRestorani']);
        Route::get('/po-kategorijama', [StatistikaController::class, 'statistikaPoKategorijama']);
    });
    
    // Eksport (samo moje porudžbine)
    Route::get('eksport/moje-porudzbine', [EksportController::class, 'eksportMojePorudzbine']);
});
