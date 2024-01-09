<?php

namespace App\Http\Controllers;

use App\Models\Miembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MiembroController extends Controller
{
    public function index(){
        $miembros = Miembro::all();

        return view('miembros.index', ['miembros'=>$miembros]);
    }

    public function create(){
        return view('miembros.create');
    }

    public function store(Request $request){
        $miembro = new Miembro();
        $request->validate([
            'nombre_apellido' => 'required',
            'cedula' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required',
            'genero' => 'required',
            'cargo' => 'required',
        ]);

        $miembro->nombre_apellido = $request->nombre_apellido;
        $miembro->cedula = $request->cedula;
        $miembro->fecha_nacimiento = $request->fecha_nacimiento;
        $miembro->email = $request->email;
        $miembro->telefono = $request->telefono;
        $miembro->genero = $request->genero;
        $miembro->cargo = $request->cargo;
        $miembro->direccion = $request->direccion;
        if ($request->hasFile('foto')){
            $miembro->foto = $request->file('foto')->store('foto_miembro', 'public');
        }
        $miembro->estado = '1';
        $miembro->fecha_ingreso = '2023-01-09';
        
        $miembro->save();
        return redirect('/miembros');
    }
}
