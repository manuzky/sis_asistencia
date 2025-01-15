<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\HorarioMateria;
use App\Models\Materia;
use App\Models\Miembro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Horario;
use App\Models\Pnf;

class HorarioMateriaController extends Controller
{
    // Función para generar el PDF de asistencias
    public function pdf_pnf(Request $request)
    {
        // Obtener los datos de la tabla 'asistencias'
        $asistencias = Asistencia::paginate();

        // Obtener los datos de otras tablas relacionadas
        $horarios = Horario::all();
        $pnfs = Pnf::all();
        $materias = Materia::all();
        $Materias = Materia::all();

        // Obtener los datos de 'horario_materia' y los profesores
        $horarioMaterias = HorarioMateria::with(['materia', 'profesor'])->get();

        // Generar el PDF con los datos pasados a la vista
        $pdf = Pdf::loadView('reportes.pdf_pnf', [
            'asistencias' => $asistencias,
            'Materias' => $Materias,
            'horarios' => $horarios,
            'materias' => $materias,
            'pnfs' => $pnfs,
            'horarioMaterias' => $horarioMaterias, // Pasamos los datos de horarios y profesores
        ]);

        return $pdf->stream();
    }
}
