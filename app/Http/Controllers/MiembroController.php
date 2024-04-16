<?php

namespace App\Http\Controllers;

use App\Models\Miembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MiembroController extends Controller
{
    public function index(){
        $miembros = Miembro::all();

        return view('miembros.index', ['miembros'=>$miembros]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create(){
        return view('miembros.create');
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

        return view('miembros.show', ['miembro'=>$miembro]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function edit($id){
        $miembro = Miembro::findOrFail($id);

        return view('miembros.edit', ['miembro'=>$miembro]);
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

        return redirect()->route('miembros.index')->with('mensaje', 'Se eliminó el registro correctamente.');
    }
}
