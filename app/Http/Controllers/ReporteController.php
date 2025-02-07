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
use App\Models\Turno;



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
    $turnos = Turno::all(); // Obtener todos los turnos disponibles

    return view('reportes.index', compact('turnos'));
}


/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf(Request $request)
    {
        $turnosSeleccionados = $request->input('turnos', []); // Recibe los turnos seleccionados

        // Si hay turnos seleccionados, filtrar las asistencias por turno
        if (!empty($turnosSeleccionados)) {
            $asistencias = Asistencia::whereHas('miembro.turnos', function ($query) use ($turnosSeleccionados) {
                $query->whereIn('turno_id', $turnosSeleccionados);
            })->get();
        } else {
            $asistencias = Asistencia::all(); // Si no hay filtro, traer todas las asistencias
        }

        $pdf = Pdf::loadView('reportes.pdf', ['asistencias' => $asistencias])
                ->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_fechas(Request $request)
    {
        $fi = $request->fi;
        $ff = $request->ff;
        $turnosSeleccionados = $request->input('turnos', []);

        // Filtrar asistencias por fechas
        $asistencias = Asistencia::whereBetween('fecha', [$fi, $ff]);

        // Si se seleccionaron turnos, aplicar filtro adicional
        if (!empty($turnosSeleccionados)) {
            $asistencias->whereHas('miembro.turnos', function ($query) use ($turnosSeleccionados) {
                $query->whereIn('turno_id', $turnosSeleccionados);
            });
        }

        $asistencias = $asistencias->get(); // Obtener los resultados finales

        $pdf = Pdf::loadView('reportes.pdf_fechas', ['asistencias' => $asistencias])
                ->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_cargo(Request $request)
    {
        // Obtener el cargo seleccionado
        $cargoId = $request->input('cargo');
        $cargo = Cargo::findOrFail($cargoId); // Obtener el cargo por su ID

        // Obtener los turnos seleccionados (pueden ser múltiples)
        $turnosSeleccionados = $request->input('turnos', []);  // Recibe los turnos seleccionados

        // Filtrar las asistencias basadas en el cargo y los turnos seleccionados
        $asistencias = Asistencia::whereHas('miembro.cargo', function ($query) use ($cargoId) {
            $query->where('cargo_id', $cargoId);  // Filtrar por el cargo
        })
        ->whereHas('miembro.turnos', function ($query) use ($turnosSeleccionados) {
            // Si hay turnos seleccionados, filtramos por ellos
            if (!empty($turnosSeleccionados)) {
                $query->whereIn('turno_id', $turnosSeleccionados);
            }
        })
        ->get();

        // Generar el PDF con los datos obtenidos
        $pdf = Pdf::loadView('reportes.pdf_cargo', [
            'asistencias' => $asistencias,
            'cargo' => $cargo->nombre_cargo
        ]);

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_fechas_cargo(Request $request)
    {
        // Obtener el ID del cargo seleccionado
        $cargoId = $request->input('cargo'); 
        // Obtener las fechas de inicio y final
        $fi = $request->input('fi'); 
        $ff = $request->input('ff'); 

        // Asegúrate de que las fechas están en formato adecuado antes de pasarlas a la consulta
        $fi = \Carbon\Carbon::parse($fi)->startOfDay(); 
        $ff = \Carbon\Carbon::parse($ff)->endOfDay();

        // Obtener los turnos seleccionados
        $turnosSeleccionados = $request->input('turnos', []);  // Recibe los turnos seleccionados

        // Filtramos las asistencias por cargo, fechas y turnos
        $asistencias = Asistencia::whereHas('miembro.cargo', function ($query) use ($cargoId) {
            $query->where('cargo_id', $cargoId);  // Filtrar por el cargo
        })
        ->whereBetween('fecha', [$fi, $ff])  // Filtrar por el rango de fechas
        ->whereHas('miembro.turnos', function ($query) use ($turnosSeleccionados) {
            // Filtrar por los turnos seleccionados
            if (!empty($turnosSeleccionados)) {
                $query->whereIn('turno_id', $turnosSeleccionados);
            }
        })
        ->get();

        $cargo = Cargo::findOrFail($cargoId);  // Obtener el nombre del cargo

        // Generar el PDF con los datos obtenidos
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