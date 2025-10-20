<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KategorijaController;
use App\Http\Controllers\Api\RestoranController;
use App\Http\Controllers\Api\JeloController;
use App\Http\Controllers\Api\PorudzbinaController;
use App\Http\Controllers\Api\VremeController;
use App\Http\Controllers\Api\EksportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public rute
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public rute za pregled (bez autentifikacije)
Route::get('/kategorije', [KategorijaController::class, 'index']);
Route::get('/kategorije/{kategorija}', [KategorijaController::class, 'show']);
Route::get('/restorani', [RestoranController::class, 'index']);
Route::get('/restorani/{restoran}', [RestoranController::class, 'show']);
Route::get('/jela', [JeloController::class, 'index']);
Route::get('/jela/{jelo}', [JeloController::class, 'show']);

// Vremenska prognoza (public ruta)
Route::get('/vreme/beograd', [VremeController::class, 'getVremeZaBeograd']);
Route::get('/vreme', [VremeController::class, 'getVremeZaGrad']);

// Protected rute (zahtevaju autentifikaciju)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Admin rute za upravljanje kategorijama (zahtevaju admin prava)
    Route::middleware('admin')->group(function () {
        Route::post('/kategorije', [KategorijaController::class, 'store']);
        Route::put('/kategorije/{kategorija}', [KategorijaController::class, 'update']);
        Route::delete('/kategorije/{kategorija}', [KategorijaController::class, 'destroy']);

        // Admin rute za upravljanje restoranima
        Route::post('/restorani', [RestoranController::class, 'store']);
        Route::put('/restorani/{restoran}', [RestoranController::class, 'update']);
        Route::delete('/restorani/{restoran}', [RestoranController::class, 'destroy']);

        // Admin rute za upravljanje jelima
        Route::post('/jela', [JeloController::class, 'store']);
        Route::put('/jela/{jelo}', [JeloController::class, 'update']);
        Route::delete('/jela/{jelo}', [JeloController::class, 'destroy']);
    });

    // Rute za porudžbine
    Route::get('/porudzbine', [PorudzbinaController::class, 'index']);
    Route::post('/porudzbine', [PorudzbinaController::class, 'store']);
    Route::get('/porudzbine/{porudzbina}', [PorudzbinaController::class, 'show']);
    Route::patch('/porudzbine/{porudzbina}/status', [PorudzbinaController::class, 'updateStatus']);

    // Eksport rute (samo za admin)
    Route::middleware('admin')->group(function () {
        Route::get('/eksport/porudzbine', [EksportController::class, 'eksportPorudzbina']);
        Route::get('/eksport/restorani', [EksportController::class, 'eksportRestorana']);
    });
});
