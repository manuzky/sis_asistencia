<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:rolesypermisos')->only('index', 'show');
        $this->middleware('can:rolesypermisos.create')->only('create', 'store');
        $this->middleware('can:rolesypermisos.edit')->only('edit', 'update');
        $this->middleware('can:rolesypermisos.destroy')->only('destroy');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function index()
    {
        $roles = Role::all();

        return view('rolesypermisos.index', compact('roles'));
    }

/* ------------------------------------------------------------------------------------------------------------------ */

    public function create()
    {
        $permissions = Permission::all();

        return view('rolesypermisos.create', compact('permissions'));
    }

/* ------------------------------------------------------------------------------------------------------------------ */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'description' => 'required',
        ], [
            'name.unique' => 'El nombre del rol ya está en uso.',
        ]);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('rolesypermisos.index', $role)->with('mensaje', 'El rol y los permisos fueron creado con éxito.');
    }

/* ------------------------------------------------------------------------------------------------------------------ */

    public function show(Role $role)
    {
        return view('rolesypermisos.show', compact('role'));
    }

/* ------------------------------------------------------------------------------------------------------------------ */

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('rolesypermisos.edit', compact('role', 'permissions'));
    }

/* ------------------------------------------------------------------------------------------------------------------ */

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('rolesypermisos.index', $role->id)->with('mensaje', 'El rol y los permisos fueron actualizados con éxito.');
    }

/* ------------------------------------------------------------------------------------------------------------------ */

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('rolesypermisos.index', $role->id)->with('eliminar', 'eliminar');
    }
}
