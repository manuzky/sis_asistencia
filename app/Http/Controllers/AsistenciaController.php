<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Miembro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:asistencias')->only('index', 'show');
        $this->middleware('can:asistencias.create')->only('create', 'store');
        $this->middleware('can:asistencias.edit')->only('edit', 'update');
        $this->middleware('can:asistencias.destroy')->only('destroy');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function index()
    {
        $asistencias = Asistencia::paginate();

        // Convertir la fecha a objetos Carbon
        foreach ($asistencias as $asistencia) {
            $asistencia->fecha = Carbon::parse($asistencia->fecha);
        }

        return view('asistencia.index', compact('asistencias'))
            ->with('i', (request()->input('page', 1) - 1) * $asistencias->perPage());
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        $asistencia = new Asistencia();
        $miembros = Miembro::pluck('nombre_apellido', 'id');
        return view('asistencia.create', compact('asistencia', 'miembros'));
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'fecha' => 'required|date_format:d/m/Y',
            'hora_entrada' => 'required',
            'miembro_id' => 'required|exists:miembros,id'
        ]);

        // Modificar el formato de fecha antes de almacenarlo en la base de datos
        $fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d');
        
        // Crear la asistencia
        $asistencia = new Asistencia();
        $asistencia->fecha = $fecha;
        $asistencia->hora_entrada = $request->hora_entrada;
        $asistencia->hora_salida = $request->hora_salida;
        $asistencia->miembro_id = $request->miembro_id;

        // Asignar el usuario que está creando la asistencia
        $asistencia->user_id = auth()->id();

        $asistencia->save();

        // Redireccionar con un mensaje
        return redirect()->route('asistencias.index')->with('mensaje', 'Asistencia añadida correctamente.');
    }


/* ---------------------------------------------------------------------------------------------------------------- */

    public function show($id)
    {
        $asistencia = Asistencia::with('user')->find($id);
        $miembros = Miembro::pluck('nombre_apellido', 'id'); // O cualquier otra forma de obtener la lista de miembros

        return view('asistencia.show', compact('asistencia', 'miembros'));
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function edit($id)
    {
        $asistencia = Asistencia::find($id);
        $miembros = Miembro::pluck('nombre_apellido', 'id');
        return view('asistencia.edit', compact('asistencia', 'miembros'));
    }

/* ---------------------------------------------------------------------------------------------------------------- */

public function update(Request $request, Asistencia $asistencia)
{
    // Validación de datos
    $request->validate([
        'fecha' => 'required|date_format:d/m/Y',
        'hora_entrada' => 'required',
        'hora_salida' => 'required',
        'miembro_id' => 'required|exists:miembros,id'
    ]);

    // Modificar el formato de fecha antes de almacenarlo en la base de datos
    $fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d');

    // Actualizar la asistencia con los nuevos datos
    $asistencia->fecha = $fecha;
    $asistencia->hora_entrada = $request->hora_entrada;
    $asistencia->hora_salida = $request->hora_salida;
    $asistencia->miembro_id = $request->miembro_id;
    $asistencia->updated_by = auth()->id();
    $asistencia->save();

    // Redireccionar con un mensaje
    return redirect()->route('asistencias.index')->with('mensaje', 'Asistencia actualizada correctamente');
}

/* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy($id)
    {
        $asistencia = Asistencia::find($id)->delete();
        $miembro = Miembro::find($id);
        return redirect()->route('asistencias.index')->with('eliminar', 'eliminar');

    }
}
