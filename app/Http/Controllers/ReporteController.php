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
        $fecha = now()->format('d/m/Y'); // Obtiene la fecha actual en formato día/mes/año

        // Si hay turnos seleccionados, obtenerlos de la base de datos
        $turnos = Turno::whereIn('id', $turnosSeleccionados)->pluck('nombre')->toArray();
        $turno = empty($turnos) ? 'Todos' : implode(', ', $turnos); // Si no hay filtro, mostrar "Todos"

        // Si hay turnos seleccionados, filtrar las asistencias por turno
        if (!empty($turnosSeleccionados)) {
            $asistencias = Asistencia::whereHas('miembro.turnos', function ($query) use ($turnosSeleccionados) {
                $query->whereIn('turno_id', $turnosSeleccionados);
            })
            ->orderBy('fecha', 'desc') // Ordenar por fecha descendente
            ->orderBy('hora_entrada', 'desc') // Opcional: ordenar por hora de entrada
            ->get();
        } else {
            $asistencias = Asistencia::orderBy('fecha', 'desc')->orderBy('hora_entrada', 'desc')->get();
        }
        

        $pdf = Pdf::loadView('reportes.pdf', [
                    'asistencias' => $asistencias,
                    'fecha' => $fecha, // Pasar la fecha a la vista
                    'turno' => $turno // Pasar el turno a la vista
                ])
                ->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_fechas(Request $request)
    {
        $fi = $request->fi;
        $ff = $request->ff;
        $fecha = now()->format('d/m/Y'); // Fecha actual de expedición
        $turnosSeleccionados = $request->input('turnos', []);

        // Obtener los nombres de los turnos seleccionados
        $turnos = Turno::whereIn('id', $turnosSeleccionados)->pluck('nombre')->toArray();
        $turno = empty($turnos) ? 'Todos' : implode(', ', $turnos);

        // Rango de fechas formateado
        $rango_fechas = \Carbon\Carbon::parse($fi)->format('d/m/Y') . ' a ' . \Carbon\Carbon::parse($ff)->format('d/m/Y');

        // Filtrar asistencias por fechas y turnos si están seleccionados
        $asistencias = Asistencia::whereBetween('fecha', [$fi, $ff]);

        if (!empty($turnosSeleccionados)) {
            $asistencias->whereHas('miembro.turnos', function ($query) use ($turnosSeleccionados) {
                $query->whereIn('turno_id', $turnosSeleccionados);
            });
        }

        $asistencias = $asistencias->orderBy('fecha', 'desc')->orderBy('hora_entrada', 'desc')->get();

        $pdf = Pdf::loadView('reportes.pdf_fechas', [
                    'asistencias' => $asistencias,
                    'fecha' => $fecha,
                    'turno' => $turno,
                    'rango_fechas' => $rango_fechas
                ])
                ->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_cargo(Request $request)
    {
        $fecha = now()->format('d/m/Y'); // Fecha de expedición del reporte

        // Obtener el cargo seleccionado
        $cargoId = $request->input('cargo');
        $cargo = Cargo::findOrFail($cargoId); // Obtener el nombre del cargo

        // Obtener los turnos seleccionados
        $turnosSeleccionados = $request->input('turnos', []);

        // Obtener los nombres de los turnos seleccionados
        $turnos = Turno::whereIn('id', $turnosSeleccionados)->pluck('nombre')->toArray();
        $turno = empty($turnos) ? 'Todos' : implode(', ', $turnos); // Si no hay filtro, mostrar "Todos"

        // Filtrar las asistencias por cargo y turnos seleccionados
        $asistencias = Asistencia::whereHas('miembro.cargo', function ($query) use ($cargoId) {
            $query->where('cargo_id', $cargoId);
        });

        // Si hay turnos seleccionados, aplicar el filtro
        if (!empty($turnosSeleccionados)) {
            $asistencias->whereHas('miembro.turnos', function ($query) use ($turnosSeleccionados) {
                $query->whereIn('turno_id', $turnosSeleccionados);
            });
        }

        // Ordenar las asistencias por fecha y hora de entrada descendente
        $asistencias = $asistencias->orderBy('fecha', 'desc')->orderBy('hora_entrada', 'desc')->get();

        // Generar el PDF con la nueva estructura
        $pdf = Pdf::loadView('reportes.pdf_cargo', [
            'asistencias' => $asistencias,
            'cargo' => $cargo->nombre_cargo,
            'fecha' => $fecha,
            'turno' => $turno
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_fechas_cargo(Request $request) 
    {
        $cargoId = $request->input('cargo'); 
        $fi = $request->input('fi'); 
        $ff = $request->input('ff'); 
        $fecha = now()->format('d/m/Y'); // Fecha de expedición

        // Formatear el rango de fechas
        $rango_fechas = \Carbon\Carbon::parse($fi)->format('d/m/Y') . ' a ' . \Carbon\Carbon::parse($ff)->format('d/m/Y');

        // Asegurar el formato correcto de las fechas
        $fi = \Carbon\Carbon::parse($fi)->startOfDay(); 
        $ff = \Carbon\Carbon::parse($ff)->endOfDay();

        // Obtener los turnos seleccionados
        $turnosSeleccionados = $request->input('turnos', []);  
        $turnos = Turno::whereIn('id', $turnosSeleccionados)->pluck('nombre')->toArray();
        $turno = empty($turnos) ? 'Todos' : implode(', ', $turnos);

        // Filtrar asistencias por cargo, fechas y turnos
        $asistencias = Asistencia::whereHas('miembro.cargo', function ($query) use ($cargoId) {
            $query->where('cargo_id', $cargoId);
        })
        ->whereBetween('fecha', [$fi, $ff])
        ->whereHas('miembro.turnos', function ($query) use ($turnosSeleccionados) {
            if (!empty($turnosSeleccionados)) {
                $query->whereIn('turno_id', $turnosSeleccionados);
            }
        })
        ->orderBy('fecha', 'desc')
        ->orderBy('hora_entrada', 'desc')
        ->get();

        $cargo = Cargo::findOrFail($cargoId);

        // Generar el PDF con los datos obtenidos
        $pdf = Pdf::loadView('reportes.pdf_fechas_cargo', [
            'asistencias' => $asistencias,
            'cargo' => strtoupper($cargo->nombre_cargo), // En mayúsculas
            'fecha' => $fecha,
            'turno' => $turno,
            'rango_fechas' => $rango_fechas
        ])->setPaper('a4', 'landscape');

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