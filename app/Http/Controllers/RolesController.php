<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\Permiso;

class RolController extends Controller
{
    // Mostrar todos los roles
    public function index()
    {
        $roles = Roles::all();
        return view('roles.index', compact('roles'));
    }

    // Mostrar formulario para crear un nuevo rol
    public function create()
    {
        return view('roles.create');
    }

    // Almacenar un nuevo rol
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:25|unique:roles,nombre',
        ]);

        Rol::create(['nombre' => $request->nombre]);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    // Mostrar formulario para editar un rol
    public function edit($id)
    {
        $rol = Roles::findOrFail($id);
        return view('roles.edit', compact('rol'));
    }

    // Actualizar rol existente
    public function update(Request $request, $id)
    {
        $rol = Roles::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:25|unique:roles,nombre,' . $rol->id,
        ]);

        $rol->update(['nombre' => $request->nombre]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $rol = Roles::findOrFail($id);
        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }

    public function editarPermisos($id)
    {
        $rol = Roles::findOrFail($id);
        $permisos = Permiso::all();
        $permisosAsignados = $rol->permisos->pluck('id')->toArray();

        return view('roles.editar_permisos', compact('rol', 'permisos', 'permisosAsignados'));
    }

    public function actualizarPermisos(Request $request, $id)
    {
        $rol = Roles::findOrFail($id);

        $request->validate([
            'permisos' => 'array',
            'permisos.*' => 'exists:permisos,id',
        ]);

        // Sincronizar permisos
        $rol->permisos()->sync($request->permisos ?? []);

        return redirect()->route('roles.index')->with('success', 'Permisos actualizados correctamente.');
    }

}
