<?php

namespace App\Http\Controllers;

use App\Models\Miembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Cargo;
use App\Models\Turno;

class MiembroController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:miembros')->only('index', 'show');
        $this->middleware('can:miembros.create')->only('create', 'store');
        $this->middleware('can:miembros.edit')->only('edit', 'update');
        $this->middleware('can:miembros.destroy')->only('destroy');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function toggleEstado($id) {
        $miembro = Miembro::findOrFail($id);
        $miembro->estado = $miembro->estado == '1' ? '2' : '1'; // Cambiar entre 'Activo' (1) e 'Inactivo' (2)
        $miembro->save();

        return redirect()->route('miembros.index')->with('mensaje', 'El estado del miembro ha sido actualizado correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

public function index(){
    $miembros = Miembro::all();
    $cargos = Cargo::pluck('nombre_cargo', 'id');
    $turnos = Turno::all();  // Obtener los turnos disponibles

    return view('miembros.index', ['miembros' => $miembros, 'cargos' => $cargos, 'turnos' => $turnos]);
}

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create(){
        $cargos = Cargo::where('nombre_cargo', '!=', 'Desarrollador')->pluck('nombre_cargo', 'id');
        $turnos = Turno::all();  // Obtener los turnos disponibles

        return view('miembros.create', ['cargos' => $cargos, 'turnos' => $turnos]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

public function store(Request $request){
    $request->validate([
        'nombre_apellido' => 'required',
        'cedula' => 'required',
        'fecha_nacimiento' => 'required',
        'email' => 'required',
        'genero' => 'required',
        'cargo' => 'required|exists:cargos,id', // Asegura que el ID del cargo exista en la tabla de cargos
        'turnos' => 'required|array',  // Asegura que se seleccionen turnos
        'turnos.*' => 'exists:turnos,id',  // Asegura que los turnos existan
    ]);

    // Validación personalizada para cédula y correo electrónico únicos
    $request->validate([
        'cedula' => Rule::unique('miembros')->where(function ($query) use ($request) {
            return $query->where('cedula', $request->cedula)->orWhere('email', $request->email);
        }),
        'email' => Rule::unique('miembros')->where(function ($query) use ($request) {
            return $query->where('cedula', $request->cedula)->orWhere('email', $request->email);
        }),
    ], [
        'cedula.unique' => 'El número de cédula ya está en uso.',
        'email.unique' => 'El correo electrónico ya está en uso.',
    ]);

    $fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $request->fecha_nacimiento)->format('Y-m-d');

    $miembro = new Miembro();
    $miembro->nombre_apellido = $request->nombre_apellido;
    $miembro->cedula = $request->cedula;
    $miembro->fecha_nacimiento = $fecha_nacimiento; // Asigna la fecha formateada
    $miembro->email = $request->email;
    $miembro->telefono = $request->telefono;
    $miembro->genero = $request->genero;
    $miembro->cargo_id = $request->cargo; // Asigna el ID del cargo enviado desde el formulario
    $miembro->direccion = $request->direccion;
    
    if ($request->hasFile('foto')){
        $miembro->foto = $request->file('foto')->store('foto_miembro', 'public');
    }

    $miembro->estado = '1';
    $miembro->fecha_ingreso = now()->format('Y-m-d');
    
    $miembro->save();

    // Asociar los turnos seleccionados con el miembro
    $miembro->turnos()->sync($request->turnos);  // Sincroniza los turnos seleccionados

    return redirect()->route('miembros.index')->with('mensaje', 'El miembro fue registrado correctamente.');
}




/* ---------------------------------------------------------------------------------------------------------------- */

    public function show($id){
        $miembro = Miembro::findOrFail($id);
        $cargos = Cargo::pluck('nombre_cargo', 'id');
        $turnos = Turno::all(); // Obtener todos los turnos disponibles
        $turnosAsignados = $miembro->turnos->pluck('id')->toArray(); // Obtener los turnos asignados al miembro

        return view('miembros.show', [
            'miembro' => $miembro, 
            'cargos' => $cargos, 
            'turnos' => $turnos, 
            'turnosAsignados' => $turnosAsignados
        ]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function edit($id){
        $miembro = Miembro::findOrFail($id);
        $cargos = Cargo::where('nombre_cargo', '!=', 'Desarrollador')->pluck('nombre_cargo', 'id'); // Obtener lista de cargos disponibles
        $turnos = Turno::all();  // Obtener todos los turnos disponibles
        $turnosAsignados = $miembro->turnos->pluck('id')->toArray();  // Obtener los turnos ya asignados al miembro

        return view('miembros.edit', [
            'miembro' => $miembro, 
            'cargos' => $cargos, 
            'turnos' => $turnos, 
            'turnosAsignados' => $turnosAsignados  // Pasar los turnos asignados al miembro
        ]);
    }


/* ------------------------------------------------------------------------------------------------------------------ */

    public function update(Request $request, $id){
        $request->validate([
            'nombre_apellido' => 'required',
            'cedula' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required',
            'genero' => 'required',
            'cargo' => 'required|exists:cargos,id', // Asegura que el ID del cargo exista en la tabla de cargos
            'turnos' => 'required|array',  // Validar que se seleccionen turnos
            'turnos.*' => 'exists:turnos,id',  // Asegura que los turnos existan
        ]);

        $miembro = Miembro::find($id);

        $miembro->nombre_apellido = $request->nombre_apellido;
        $miembro->cedula = $request->cedula;

        // Convertir la fecha al formato correcto antes de asignarla al modelo
        $fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $request->fecha_nacimiento)->format('Y-m-d');
        $miembro->fecha_nacimiento = $fecha_nacimiento;

        $miembro->email = $request->email;
        $miembro->telefono = $request->telefono;
        $miembro->genero = $request->genero;
        $miembro->cargo_id = $request->cargo; // Asigna el ID del cargo enviado desde el formulario
        $miembro->direccion = $request->direccion;

        if ($request->hasFile('foto')){
            Storage::delete('public/'.$miembro->foto);
            $miembro->foto = $request->file('foto')->store('foto_miembro', 'public');
        }

        $miembro->save();

        // Sincroniza los turnos seleccionados con el miembro
        $miembro->turnos()->sync($request->turnos);  // Sincroniza los turnos seleccionados

        return redirect()->route('miembros.index')->with('mensaje', 'Se actualizó el registro correctamente.');
    }


/* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy($id){
        $miembro = Miembro::find($id);
        Storage::delete('public/'.$miembro->foto);
        Miembro::destroy($id);

        return redirect()->route('miembros.index')->with('eliminar', 'eliminar');
    }
}
