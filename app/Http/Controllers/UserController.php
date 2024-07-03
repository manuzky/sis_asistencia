<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\Miembro;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:usuarios')->only('index', 'show');
        $this->middleware('can:usuarios.habilitar')->only('usuarios.habilitar');
        $this->middleware('can:usuarios.create')->only('create', 'store');
        $this->middleware('can:usuarios.edit')->only('edit', 'update');
        $this->middleware('can:usuarios.destroy')->only('destroy');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();

        return redirect()->back()->with('mensaje', 'Estado del usuario actualizado correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function index()
    {
        $usuarios = User::with('roles')->get();
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        $roles = Role::all();
        $miembros = Miembro::all();
        return view('usuarios.create', compact('miembros', 'roles'));
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
            'miembro_id' => 'required|exists:miembros,id', // Validar que el miembro seleccionado existe
            'password' => 'required|string|min:8|confirmed',
        ], [
            'miembro_id.exists' => 'El miembro seleccionado no existe.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        // Obtener el miembro seleccionado
        $miembro = Miembro::findOrFail($request->miembro_id);

        // Crear el nuevo usuario
        $usuario = new User();
        $usuario->name = $miembro->nombre_apellido; // Nombre del miembro
        $usuario->email = $miembro->email; // Email del miembro
        $usuario->password = Hash::make($request['password']);
        $usuario->fecha_ingreso = date($format = 'Y-m-d');
        $usuario->estado = 1;
        $usuario->miembro_id = $miembro->id; // Asignar el ID del miembro al usuario
        $usuario->save();
        
        // Asignar roles si es necesario
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
        $miembros = Miembro::all();
        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario', 'miembros', 'roles'));
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $miembro = Miembro::findOrFail($request->miembro_id);

        // Actualizar solo los campos que se están modificando
        $usuario->name = $miembro->nombre_apellido; // Actualizar el nombre de usuario
        $usuario->email = $request->email;
        if ($request->has('password')) {
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        // Actualizar roles
        $usuario->roles()->sync($request->roles);

        return redirect()->route('usuarios.index')->with('mensaje', 'Se actualizó el usuario correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy(string $id)
    {
        User::destroy($id);

        return redirect()->route('usuarios.index')->with('eliminar', 'eliminar');
    }
}
