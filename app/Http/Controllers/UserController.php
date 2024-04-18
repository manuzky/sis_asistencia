<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', ['usuarios'=>$usuarios]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        return view('usuarios.create');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->fecha_ingreso = date($format = 'Y-m-d');
        $usuario->estado = 1;
        $usuario->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Se añadió al usuario correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function show($id)
    {
        $usuario = User::findOrFail($id);

        return view('usuarios.show', ['usuario'=>$usuario]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function edit($id)
    {
        $roles = Role::all();
        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->roles()->sync($request->roles);
        
        $usuario->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Se actualizó el usuario correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy(string $id)
    {
        User::destroy($id);

        return redirect()->route('usuarios.index')->with('mensaje', 'Se eliminó al usuario correctamente.');
    }
}
