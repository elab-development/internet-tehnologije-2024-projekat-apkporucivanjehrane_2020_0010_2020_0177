<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KategorijaController;
use App\Http\Controllers\Api\RestoranController;
use App\Http\Controllers\Api\JeloController;
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

// Protected rute (zahtevaju autentifikaciju)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Admin rute za upravljanje kategorijama (zahtevaju admin prava)
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
