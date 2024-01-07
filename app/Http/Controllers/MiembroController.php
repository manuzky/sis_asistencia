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
}
