<?php

namespace App\Http\Controllers;

use App\Models\Miembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Cargo;

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

    public function index(){
        $miembros = Miembro::all();

        return view('miembros.index', ['miembros'=>$miembros]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create(){
        $cargos = Cargo::pluck('nombre_cargo', 'id');

        return view('miembros.create', ['cargos' => $cargos]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request){
        $request->validate([
            'nombre_apellido' => 'required',
            'cedula' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required',
            'genero' => 'required',
            'cargo' => 'required',
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
        $miembro->cargo = $request->cargo;
        $miembro->direccion = $request->direccion;
        if ($request->hasFile('foto')){
            $miembro->foto = $request->file('foto')->store('foto_miembro', 'public');
        }
        $miembro->estado = '1';
        $miembro->fecha_ingreso = date($format = 'Y-m-d');
        
        $miembro->save();
        return redirect()->route('miembros.index')->with('mensaje', 'El miembro fue registrado correctamente.');
    }


/* ---------------------------------------------------------------------------------------------------------------- */

    public function show($id){
        $miembro = Miembro::findOrFail($id);
        $cargos = Cargo::pluck('nombre_cargo', 'id');

        return view('miembros.show', ['miembro'=>$miembro, 'cargos' => $cargos]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function edit($id){
        $miembro = Miembro::findOrFail($id);
        $cargos = Cargo::pluck('nombre_cargo', 'id'); // Obtener lista de cargos disponibles

        return view('miembros.edit', ['miembro' => $miembro, 'cargos' => $cargos]);
    }


/* ------------------------------------------------------------------------------------------------------------------ */

public function update(Request $request, $id){
    $request->validate([
        'nombre_apellido' => 'required',
        'cedula' => 'required',
        'fecha_nacimiento' => 'required',
        'email' => 'required',
        'genero' => 'required',
        'cargo' => 'required',
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
    $miembro->cargo = $request->cargo;
    $miembro->direccion = $request->direccion;

    if ($request->hasFile('foto')){
        Storage::delete('public/'.$miembro->foto);
        $miembro->foto = $request->file('foto')->store('foto_miembro', 'public');
    }

    $miembro->save();
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
