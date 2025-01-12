<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\PNF;
use App\Models\Miembro;
use App\Models\Materia;

class HorarioController extends Controller
{

    public function getMateriasByPnf(Request $request)
    {
        $materias = Materia::where('pnf_id', $request->pnf_id)->get();

        return response()->json($materias);
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function index()
    {
        $horarios = Horario::all();  // Obtiene todos los horarios de la base de datos
        return view('horarios.index', compact('horarios'));  // Retorna la vista con los horarios
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        $pnfs = PNF::all();  // Obtener todos los PNF
        $materias = collect(); // Inicialmente vacío, ya que no hay PNF seleccionado
        $materias = Materia::all();  // Obtener todas las materias
        $docentes = Miembro::where('cargo_id', 2)->get();  // Obtener solo los miembros con cargo "Docente" (cargo_id = 2)
        
        return view('horarios.create', compact('pnfs', 'docentes', 'materias'));  // Pasar los docentes a la vista
    }
    

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'pnf_id' => 'required|exists:pnfs,id',
            'trayecto' => 'required|string',
            'semestre' => 'required|string',
            'turno' => 'required|string',
            'materias' => 'required|array',
            'profesor_id' => 'required|exists:miembros,id',
        ]);
        dd($validated);

        // Crear el horario
        $horario = Horario::create([
            'pnf_id' => $validated['pnf_id'],
            'trayecto' => $validated['trayecto'],
            'semestre' => $validated['semestre'],
            'turno' => $validated['turno'],
            'profesor_id' => $validated['profesor_id'],
        ]);

        // Asignar las materias al horario
        $horario->materias()->attach($validated['materias']);

        return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente');
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function show(Horario $horario)
    {
        return view('horarios.show', compact('horario'));  // Pasamos el horario a la vista
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function edit(Horario $horario)
    {
        $pnfs = PNF::all();
        $miembros = Miembro::where('cargo_id', 2)->get();
        return view('horarios.edit', compact('horario', 'pnfs', 'miembros'));
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, Horario $horario)
    {
        $validated = $request->validate([
            'pnf_id' => 'required|exists:pnfs,id',
            'trayecto' => 'required|integer',
            'semestre' => 'required|integer',
            'turno' => 'required|string',
            'materias' => 'required|array',
            'profesor_id' => 'required|exists:miembros,id',
        ]);

        $horario->update([
            'pnf_id' => $validated['pnf_id'],
            'trayecto' => $validated['trayecto'],
            'semestre' => $validated['semestre'],
            'turno' => $validated['turno'],
            'profesor_id' => $validated['profesor_id'],
        ]);

        // Actualizar las materias asignadas
        $horario->materias()->sync($validated['materias']);

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente');
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy(Horario $horario)
    {
        $horario->materias()->detach();  // Eliminar las relaciones de materias
        $horario->delete();  // Eliminar el horario
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado correctamente');
    }

}
