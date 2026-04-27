<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CamaraController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UsuarioController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('camaras',  CamaraController::class);
Route::resource('alertas',  AlertaController::class);
Route::resource('eventos',  EventoController::class);
Route::resource('usuarios', UsuarioController::class);