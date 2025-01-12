<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\HorarioController;  // Asegúrate de importar el controlador
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PNFController;
use App\Http\Controllers\MateriaController;
use App\Models\Materia;

Route::get('/', [AdminController::class, 'index'])->middleware('auth')->name('index');
Route::get('/reportes', [ReporteController::class, 'index'])->middleware('can:reportes')->name('reportes');
Route::get('/reportes/pdf', [ReporteController::class, 'pdf'])->name('pdf');
Route::get('/reportes/pdf_fechas', [ReporteController::class, 'pdf_fechas'])->name('pdf_fechas');
Route::get('/home', [HomeController::class, 'index'])->name('home')->name('home');
Route::get('/miembros/{id}/toggle', [MiembroController::class, 'toggleEstado'])->middleware('can:miembros')->name('miembros.toggle');
Route::get('/usuarios/toggleActive/{id}', [UserController::class, 'toggleActive'])->name('usuarios.toggleActive');

Auth::routes(['register'=>false]);

Route::resource('pnfs', PNFController::class);
Route::resource('/asistencias', AsistenciaController::class)->middleware('can:asistencias');
Route::resource('/cargos', CargoController::class)->middleware('can:cargos');
Route::resource('/miembros', MiembroController::class)->middleware('can:miembros');
Route::resource('/rolesypermisos', RoleController::class)->middleware('can:rolesypermisos')->names('rolesypermisos')->parameters(['rolesypermisos' => 'role']);
Route::resource('/usuarios', UserController::class)->middleware('can:usuarios');

Route::resource('/horarios', HorarioController::class);
// ->middleware('can:horarios');  // Aquí está tu ruta de horarios

Route::get('/api/materias/{pnf_id}', function ($pnf_id) {
    $materias = Materia::where('pnf_id', $pnf_id)->get();
    return response()->json(['materias' => $materias]);
});
// Route::get('/materias/by-pnf', [HorarioController::class, 'getMateriasByPnf'])->name('materias.byPnf');

Route::post('/registrar-asistencia', [AdminController::class, 'registrarAsistencia'])->name('registrarAsistencia');