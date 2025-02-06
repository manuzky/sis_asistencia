<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use App\Models\Cargo;
use App\Models\PNF;
use App\Models\Horario;
use App\Models\Materia;
use App\Models\HorarioMateria;



class ReporteController extends Controller
{
        public function __construct()
    {
        $this->middleware('can:reportes')->only('index');
        $this->middleware('can:reportes.asistencias')->only('pdf', 'pdf_fechas');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function index()
    {
        return view('reportes.index');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf()
    {
        $asistencias = Asistencia::paginate();
        $pdf = Pdf::loadView('reportes.pdf', ['asistencias'=>$asistencias]);

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_fechas(Request $request)
    {
        $fi = $request->fi;
        $ff = $request->ff;
        $asistencias = Asistencia::where('fecha', '>=', $fi)
            ->where('fecha', '<=', $ff)
            ->get();
        $pdf = Pdf::loadView('reportes.pdf_fechas', ['asistencias'=>$asistencias]);

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_cargo(Request $request)
    {
        $cargoId = $request->input('cargo');
        $cargo = Cargo::findOrFail($cargoId); // Obtenemos el cargo
        // Filtramos las asistencias que tienen el cargo correspondiente
        $asistencias = Asistencia::whereHas('miembro.cargo', function ($query) use ($cargoId) {
            $query->where('cargo_id', $cargoId); // Filtramos por el cargo del miembro
        })->get();

        $pdf = Pdf::loadView('reportes.pdf_cargo', [
            'asistencias' => $asistencias,
            'cargo' => $cargo->nombre_cargo
        ]);

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_fechas_cargo(Request $request)
    {
        $cargoId = $request->input('cargo'); // Obtenemos el ID del cargo
        $fi = $request->input('fi'); // Fecha de inicio
        $ff = $request->input('ff'); // Fecha de finalización

        // Asegúrate de que las fechas están en formato adecuado antes de pasarlas a la consulta
        $fi = \Carbon\Carbon::parse($fi)->startOfDay(); 
        $ff = \Carbon\Carbon::parse($ff)->endOfDay();

        // Filtramos las asistencias por cargo y fechas
        $asistencias = Asistencia::whereHas('miembro.cargo', function ($query) use ($cargoId) {
            $query->where('cargo_id', $cargoId); // Filtramos por el ID del cargo
        })
        ->whereBetween('fecha', [$fi, $ff]) // Filtramos por el rango de fechas
        ->get();

        $cargo = Cargo::findOrFail($cargoId); // Obtenemos el nombre del cargo

        $pdf = Pdf::loadView('reportes.pdf_fechas_cargo', [
            'asistencias' => $asistencias,
            'cargo' => $cargo->nombre_cargo,
        ]);

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

// public function pdf_pnf(Request $request)
// {
//     // Obtener los datos de la tabla 'asistencias'
//     $asistencias = Asistencia::with('miembro', 'horariosMaterias.materia', 'horariosMaterias.profesor')->paginate();

//     // Obtener otros datos relacionados
//     $horarios = Horario::all();
//     $pnfs = Pnf::all();
//     $materias = Materia::all();

//     // Obtener los datos de 'horario_materia' y los profesores
//     $horarioMaterias = HorarioMateria::with(['materia', 'profesor'])->get();

//     // Generar el PDF con los datos pasados a la vista
//     $pdf = Pdf::loadView('reportes.pdf_pnf', [
//         'asistencias' => $asistencias,
//         'horarios' => $horarios,
//         'materias' => $materias,
//         'pnfs' => $pnfs,
//         'horarioMaterias' => $horarioMaterias, // Pasamos los datos de horarios y profesores
//     ]);

//     return $pdf->stream();
// }





/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_fechas_pnf(Request $request)
    {
        //
    }

}