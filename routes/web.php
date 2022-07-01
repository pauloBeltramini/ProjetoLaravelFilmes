<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmeController;

Route::get('/', [FilmeController::class, 'index']);
Route::get('/filmes/create', [FilmeController::class, 'create'])->middleware("auth");
Route::get('/filmes/{id}', [FilmeController::class, 'show']);
Route::post('/filmes', [FilmeController::class, 'store']);
Route::delete('/filmes/{id}', [FilmeController::class, 'destroy']);
Route::get('/filmes/edit/{id}', [FilmeController::class, 'edit'])->middleware('auth');
Route::put('/filmes/update/{id}', [FilmeController::class, 'update'])->middleware('auth');

Route::get('/dashboard', [FilmeController::class, 'dashboard'])->middleware('auth');

Route::post('/filmes/join/{id}', [FilmeController::class, 'joinFilme'])->middleware('auth');
