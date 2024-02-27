<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsistenciaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AdminController::class, 'index'])->middleware('auth');
Route::get('/asistencias/reportes', [AsistenciaController::class, 'reportes']);
Route::get('/asistencia/pdf', [AsistenciaController::class, 'pdf']);
Route::get('/asistencias/pdf_fechas', [AsistenciaController::class, 'pdf_fechas']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes(['register'=>false]);

Route::resource('/miembros', MiembroController::class);
Route::resource('/cargos', CargoController::class);
Route::resource('/usuarios', UserController::class);
Route::resource('/asistencias', AsistenciaController::class);
