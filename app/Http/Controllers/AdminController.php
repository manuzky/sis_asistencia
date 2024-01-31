<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Miembro;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $cargos = Cargo::all();
        $miembros = Miembro::all();
        $usuario = User::all();
        return view('index', ['cargos'=>$cargos, 'miembros'=>$miembros, 'usuario'=>$usuario]);
    }
}
