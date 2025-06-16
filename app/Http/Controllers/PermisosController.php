<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    // Mostrar todos los permisos
    public function index()
    {
        $permisos = Permiso::all();
        return view('permisos.index', compact('permisos'));
    }

    // Mostrar formulario para crear nuevo permiso
    public function create()
    {
        return view('permisos.create');
    }

    // Guardar nuevo permiso
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30|unique:permisos,nombre',
        ]);

        Permiso::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('permisos.index')->with('success', 'Permiso creado exitosamente.');
    }

    // Mostrar un permiso específico
    public function show($id)
    {
        $permiso = Permiso::findOrFail($id);
        return view('permisos.show', compact('permiso'));
    }

    // Mostrar formulario para editar permiso
    public function edit($id)
    {
        $permiso = Permiso::findOrFail($id);
        return view('permisos.edit', compact('permiso'));
    }

    // Actualizar permiso
    public function update(Request $request, $id)
    {
        $permiso = Permiso::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:30|unique:permisos,nombre,' . $permiso->id,
        ]);

        $permiso->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado exitosamente.');
    }

    // Eliminar permiso
    public function destroy($id)
    {
        $permiso = Permiso::findOrFail($id);
        $permiso->delete();

        return redirect()->route('permisos.index')->with('success', 'Permiso eliminado exitosamente.');
    }
}
