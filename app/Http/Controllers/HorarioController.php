<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\PNF;
use App\Models\Miembro;
use App\Models\Materia;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller {

    public function getMateriasByPnf(Request $request) {
        $materias = Materia::where('pnf_id', $request->pnf_id)->get();

        return response()->json($materias);
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function index() {
        $horarios = Horario::all();  // Obtiene todos los horarios de la base de datos
        // dd($horarios);
        return view('horarios.index', compact('horarios'));  // Retorna la vista con los horarios
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function create() {
        $pnfs = PNF::all();  // Obtener todos los PNF
        $materias = collect(); // Inicialmente vacío, ya que no hay PNF seleccionado
        $materias = Materia::all();  // Obtener todas las materias
        $docentes = Miembro::where('cargo_id', 2)->get();  // Obtener solo los miembros con cargo "Docente" (cargo_id = 2)

        return view('horarios.create', compact('pnfs', 'docentes', 'materias'));  // Pasar los docentes a la vista
    }


    /* ---------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {
        // Validar los datos de entrada
        $validated = $request->validate([
            'turno' => 'required|string',
            'pnf_id' => 'required|exists:pnfs,id',
            'trayecto' => 'required|string',
            'semestre' => 'required|string',
            'seccion' => 'required|string',
            'materias' => 'required|array',
            'profesor_id' => 'required|array',
            'profesor_id.*' => 'required|exists:miembros,id',
            'horarios' => 'required|array',
        ]);
        try {
            $horario = Horario::create([
                'turno' => $validated['turno'],
                'pnf_id' => $validated['pnf_id'],
                'trayecto' => $validated['trayecto'],
                'semestre' => $validated['semestre'],
                'seccion' => $validated['seccion'],
            ]);

            // indice para recorrer los arrays de materias y profesores
            $materiaProfesorIndex = 0;
            // Recorrer los horarios seleccionados
            foreach ($validated['horarios'] as $dia => $horas) {
                foreach ($horas as $hora => $materia_id) {
                    if ($materia_id) {
                        $profesor_id = $request['profesor_id'][$materiaProfesorIndex];
                        DB::table('horario_materia')->insert([
                            'horario_id' => $horario->id,
                            'materia_id' => $materia_id,
                            'profesor_id' => $profesor_id,
                            'dia' => $dia,
                            'hora' => $hora,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        // Aumentar el indice para el siguiente profesor
                        $materiaProfesorIndex++;
                    }
                }
            }
            return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente');
        } catch (\Exception $e) {
            //throw $th;
            return back()->withErrors(['error' => 'Error al crear el horario: ' . $e->getMessage()]);
        }
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function show(Horario $horario) {
        // Obtener los registros relacionados con el horario
        $horarioMaterias = DB::table('horario_materia')
            ->where('horario_id', $horario->id)
            ->get();

        // Cargar realciones (materias y profesores) para cada registro
        foreach ($horarioMaterias as $registro) {
            $registro->materia = Materia::find($registro->materia_id);
            $registro->profesor = Miembro::find($registro->profesor_id);
        }
        // extraer los dias y horas unicos de los datos
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $horas = $horarioMaterias->pluck('hora')->unique()->sort();

        return view('horarios.show', compact('horario', 'dias', 'horas', 'horarioMaterias'));  // Pasamos el horario a la vista
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function edit(Horario $horario) {
        $horario = Horario::with('materias')->find($horario->id);
        $pnfs = PNF::all();
        $docentes = Miembro::all();
        $materias = Materia::where('pnf_id', $horario->pnf_id)->get();
        $horariosAsignados = [];
        foreach ($horario->materias as $horarioMateria) {
            $horariosAsignados[$horarioMateria->pivot->turno][$horarioMateria->pivot->dia][$horarioMateria->pivot->hora] = [
                'id' => $horarioMateria->id,
                'nombre' => $horarioMateria->nombre,
            ];
        }
        return view('horarios.edit', compact('horario', 'pnfs', 'docentes', 'materias', 'horariosAsignados'));
    }

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, Horario $horario) {
        dd($request->all());
        // Validación de los datos del formulario
        $validated = $request->validate([
            'turno' => 'required|string',
            'trayecto' => 'required|string',
            'semestre' => 'required|string',
            'seccion' => 'required|string|max:255',
            'pnf_id' => 'required|exists:pnfs,id',
            'materias' => 'nullable|array',
            'materias.*' => 'nullable|exists:materias,id',
            'profesor_id' => 'nullable|array',
            'profesor_id.*' => 'nullable|exists:miembros,id',
            'horarios' => 'nullable|array',
        ]);

        // Actualizar el modelo Horario
        $horario->update([
            'turno' => $validated['turno'],
            'trayecto' => $validated['trayecto'],
            'semestre' => $validated['semestre'],
            'seccion' => $validated['seccion'],
            'pnf_id' => $validated['pnf_id'],
        ]);

        DB::table('horario_materia')->where('horario_id', $horario->id)->delete();
        $materiaProfesorIndex = 0;

        // Recorrer los horarios seleccionados
        foreach ($validated['horarios'] as $dia => $horas) {
            foreach ($horas as $hora => $materia_id) {
                if ($materia_id) {
                    $profesor_id = $validated['profesor_id'][$materiaProfesorIndex];

                    // Insertar en la tabla pivote horario_materia
                    DB::table('horario_materia')->insert([
                        'horario_id' => $horario->id,
                        'materia_id' => $materia_id,
                        'profesor_id' => $profesor_id,
                        'dia' => $dia,
                        'hora' => $hora,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Aumentar el índice para el siguiente profesor
                    $materiaProfesorIndex++;
                }
            }
        }
        // Redirigir con mensaje de éxito
        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente.');
    }





    /* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy(Horario $horario) {
        $horario->materias()->detach();  // Eliminar las relaciones de materias
        $horario->delete();  // Eliminar el horario
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado correctamente');
    }
}
