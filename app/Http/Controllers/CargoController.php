<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();

        return view('cargos.index', ['cargos'=>$cargos]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        return view ('cargos.create');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request)
    {
        $request->validate([
            'nombre_cargo' => 'required',
            'fecha_ingreso_cargo' => 'required'
        ]);

        $cargos = new Cargo();
        $cargos->nombre_cargo = $request->nombre_cargo;
        $cargos->descripcion_cargo = $request->descripcion_cargo;
        $cargos->estado_cargo = 1;
        $cargos->fecha_ingreso_cargo = $request->fecha_ingreso_cargo;
        
        $cargos->save();
        return redirect()->route('cargos.index')->with('mensaje', 'Se añadió el cargo correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function show($id)
    {
        $cargo = Cargo::findOrFail($id);

        return view('cargos.show', ['cargo'=>$cargo]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);

        return view('cargos.edit', ['cargo'=>$cargo]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_cargo' => 'required',
            'fecha_ingreso_cargo' => 'required'
        ]);

        $cargos = Cargo::find($id);
        $cargos->nombre_cargo = $request->nombre_cargo;
        $cargos->descripcion_cargo = $request->descripcion_cargo;
        $cargos->fecha_ingreso_cargo = $request->fecha_ingreso_cargo;
        
        $cargos->save();
        return redirect()->route('cargos.index')->with('mensaje', 'Se actualizó el cargo correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy($id)
    {
        Cargo::destroy($id);

        return redirect()->route('cargos.index')->with('mensaje', 'Se eliminó el cargo correctamente.');
    }
}
