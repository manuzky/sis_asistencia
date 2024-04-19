<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:usuarios')->only('index', 'show');
        $this->middleware('can:usuarios.create')->only('create', 'store');
        $this->middleware('can:usuarios.edit')->only('edit', 'update');
        $this->middleware('can:usuarios.destroy')->only('destroy');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', ['usuarios'=>$usuarios]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->fecha_ingreso = date($format = 'Y-m-d');
        $usuario->estado = 1;
        $usuario->save();
        
        $usuario->roles()->sync($request->roles);

        return redirect()->route('usuarios.index')->with('mensaje', 'Se añadió el usuario correctamente.');
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

        return redirect()->route('usuarios.index')->with('eliminar', 'eliminar');
    }
}
