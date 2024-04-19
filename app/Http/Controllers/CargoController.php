<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use App\Models\Permissions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class CargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:cargos')->only('index', 'show');
        $this->middleware('can:cargos.create')->only('create', 'store');
        $this->middleware('can:cargos.edit')->only('edit', 'update');
        $this->middleware('can:cargos.destroy')->only('destroy');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

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
            'nombre_cargo' => 'required|unique:cargos',
        ], [
            'nombre_cargo.unique' => 'El nombre del cargo ya está en uso.',
        ]);

        $cargos = new Cargo();
        $cargos->nombre_cargo = $request->nombre_cargo;
        $cargos->descripcion_cargo = $request->descripcion_cargo;
        
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
        ]);

        $cargos = Cargo::find($id);
        $cargos->nombre_cargo = $request->nombre_cargo;
        $cargos->descripcion_cargo = $request->descripcion_cargo;
        
        $cargos->save();
        return redirect()->route('cargos.index')->with('mensaje', 'Se actualizó el cargo correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy($id)
    {
        Cargo::destroy($id);

        return redirect()->route('cargos.index')->with('eliminar', 'eliminar');
    }
}
