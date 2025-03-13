<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\HorarioController;  // Asegúrate de importar el controlador
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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

Route::get('/backup', function () {
    // Definir el nombre del archivo de respaldo
    $filename = 'backup_' . now()->format('Y-m-d_H-i-s') . '.sql';
    $zipFilename = 'backup_' . now()->format('Y-m-d_H-i-s') . '.zip';

    // Ruta donde se guardará el archivo SQL temporalmente
    $sqlFilePath = storage_path('app/' . $filename);
    
    // Conectar a la base de datos y hacer un volcado de la misma
    $databaseName = env('DB_DATABASE');
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD');
    $host = env('DB_HOST');
    
    // Ejecutar mysqldump para hacer el respaldo
    $command = "mysqldump --user={$username} --password={$password} --host={$host} {$databaseName} > {$sqlFilePath}";
    $output = null;
    $resultCode = null;
    
    // Ejecutar el comando mysqldump
    exec($command, $output, $resultCode);
    
    // Verificar si el volcado fue exitoso
    if ($resultCode !== 0) {
        return back()->with('error', 'Hubo un error al generar el respaldo de la base de datos.');
    }
    
    // Comprimir el archivo .sql a .zip
    $zip = new \ZipArchive;
    $zipFilePath = storage_path('app/' . $zipFilename);
    
    if ($zip->open($zipFilePath, \ZipArchive::CREATE) === TRUE) {
        $zip->addFile($sqlFilePath, $filename); // Añadir el archivo .sql al .zip
        $zip->close();
        
        // Eliminar el archivo .sql original después de comprimirlo
        unlink($sqlFilePath);

        // Devolver el archivo comprimido para descargar
        return Response::download($zipFilePath)->deleteFileAfterSend(true);
    } else {
        return back()->with('error', 'Hubo un problema al comprimir el archivo.');
    }
})->name('backup');

Route::get('/', [AdminController::class, 'index'])->middleware('auth')->name('index');
Route::get('/reportes', [ReporteController::class, 'index'])->middleware('can:reportes')->name('reportes');
Route::get('/reportes/pdf', [ReporteController::class, 'pdf'])->name('pdf');
Route::get('/reportes/pdf_fechas', [ReporteController::class, 'pdf_fechas'])->name('pdf_fechas');
Route::get('reportes/pdf_cargo', [ReporteController::class, 'pdf_cargo'])->name('reportes.pdf_cargo');
Route::get('reportes/pdf_fechas_cargo', [ReporteController::class, 'pdf_fechas_cargo'])->name('reportes.pdf_fechas_cargo');
Route::get('/home', [HomeController::class, 'index'])->name('home')->name('home');
Route::get('/miembros/{id}/toggle', [MiembroController::class, 'toggleEstado'])->middleware('can:miembros')->name('miembros.toggle');
Route::get('/usuarios/toggleActive/{id}', [UserController::class, 'toggleActive'])->name('usuarios.toggleActive');
// Route::get('/reportes/pdf_pnf', [ReporteController::class, 'pdf_pnf'])->name('reportes.pdf_pnf');
// Route::get('/reportes/pdf_fechas_pnf', [ReporteController::class, 'pdf_fechas_pnf'])->name('reportes.pdf_fechas_pnf');

Auth::routes(['register'=>false]);

// Route::resource('pnfs', PNFController::class);
Route::resource('/asistencias', AsistenciaController::class)->middleware('can:asistencias');
Route::resource('/cargos', CargoController::class)->middleware('can:cargos');
Route::resource('/miembros', MiembroController::class)->middleware('can:miembros');
Route::resource('/rolesypermisos', RoleController::class)->middleware('can:rolesypermisos')->names('rolesypermisos')->parameters(['rolesypermisos' => 'role']);
Route::resource('/usuarios', UserController::class)->middleware('can:usuarios');

Route::resource('/horarios', HorarioController::class);
// ->middleware('can:horarios');  // Aquí está tu ruta de horarios

// Route::get('/api/materias/{pnf_id}', function ($pnf_id) {
//     $materias = Materia::where('pnf_id', $pnf_id)->get();
//     return response()->json(['materias' => $materias]);
// });
// Route::get('/materias/by-pnf', [HorarioController::class, 'getMateriasByPnf'])->name('materias.byPnf');

Route::post('/registrar-asistencia', [AdminController::class, 'registrarAsistencia'])->name('registrarAsistencia');