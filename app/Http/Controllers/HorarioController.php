<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\PNF;
use App\Models\Miembro;
use App\Models\Materia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $validated = $request->validate([
            'turno' => 'required|string',
            'pnf_id' => 'required|exists:pnfs,id',
            'trayecto' => 'required|string',
            'semestre' => 'required|string',
            'seccion' => 'required|string',
            'materias' => 'required|array',
            'profesor_id' => 'nullable|array',
            'profesor_id.*' => 'nullable|exists:miembros,id',
            'horarios' => 'required|array',
        ]);

    
        try {
            // Crear el horario
            $horario = Horario::create([
                'turno' => $validated['turno'],
                'pnf_id' => $validated['pnf_id'],
                'trayecto' => $validated['trayecto'],
                'semestre' => $validated['semestre'],
                'seccion' => $validated['seccion'],
            ]);
    
            // Combinamos las materias con sus respectivos profesores
            $profesores = array_combine($validated['materias'], $validated['profesor_id']);
    
            // Iteramos sobre los horarios
            foreach ($validated['horarios'] as $dia => $horas) {
                foreach ($horas as $hora => $materia_id) {
                    // Validamos que materia_id no sea null
                    if ($materia_id === null) {
                        continue; // Si es null, saltamos a la siguiente iteración
                    }
    
                    // Verifica si hay profesor asignado
                    $profesor_id = isset($profesores[$materia_id]) ? $profesores[$materia_id] : null;
    
                    // Inserta el horario en la base de datos
                    DB::table('horario_materia')->insert([
                        'horario_id' => $horario->id,
                        'materia_id' => $materia_id,
                        'profesor_id' => $profesor_id,
                        'dia' => $dia,
                        'hora' => $hora,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
            return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al crear el horario: ' . $e->getMessage()]);
        }
    }
    

    /* ---------------------------------------------------------------------------------------------------------------- */

    public function show(Horario $horario) {
        // Obtener los registros relacionados con el horario
        $horarioMaterias = DB::table('horario_materia')
            ->where('horario_id', $horario->id)
            ->get();
    
        // Cargar relaciones (materias y profesores) para cada registro
        foreach ($horarioMaterias as $registro) {
            $registro->materia = Materia::find($registro->materia_id);
            $registro->profesor = Miembro::find($registro->profesor_id);
        }
    
        // Definir los intervalos de las horas según el turno
        $turnos = [
            'Mañana' => [
                '8:00 – 8:45', '8:45 – 9:30', '9:30 – 10:15', '10:15 – 11:00', '11:00 – 11:45', '11:45 – 12:30'
            ],
            'Tarde' => [
                '12:30 – 1:15', '1:15 – 2:00', '2:00 – 2:45', '2:45 – 3:30', '3:30 – 4:15', '4:15 – 5:00'
            ],
            'Noche' => [
                '5:00 – 5:30', '5:30 – 6:00', '6:00 – 6:30', '6:30 – 7:00', '7:00 – 7:30', '7:30 – 8:00'
            ]
        ];
    
        // Obtener las horas según el turno del horario
        $horas = $turnos[$horario->turno];  // Obtener las horas del turno (mañana, tarde, noche)
    
        // Extraer los días
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
    
        return view('horarios.show', compact('horario', 'dias', 'horas', 'horarioMaterias'));  // Pasamos los datos a la vista
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