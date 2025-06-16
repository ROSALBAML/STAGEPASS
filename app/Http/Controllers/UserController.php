<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mostrar listado de usuarios
    public function index()
    {
        $usuarios = User::with('rol')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30',
            'apellidos' => 'required|string|max:60',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|string|email|max:60|unique:users,correo',
            'contrasena_hash' => 'required|string|max:255',
            'rol_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'contrasena_hash' => $request->contrasena_hash,
            'rol_id' => $request->rol_id,
            'creado_en' => now(),
            'activo' => true
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:30',
            'apellidos' => 'required|string|max:60',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|string|email|max:60|unique:users,correo,' . $usuario->id,
            'contrasena_hash' => 'required|string|max:255',
            'rol_id' => 'required|exists:roles,id',
        ]);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
// Mostrar formulario para asignar roles a un usuario
    public function editarRoles($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Rol::all();
        $rolesAsignados = $usuario->roles->pluck('id')->toArray();

        return view('usuarios.editar_roles', compact('usuario', 'roles', 'rolesAsignados'));
    }

    // Guardar roles asignados a un usuario
    public function actualizarRoles(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        $usuario->roles()->sync($request->roles ?? []);

        return redirect()->route('usuarios.index')->with('success', 'Roles actualizados correctamente.');
    }

}
