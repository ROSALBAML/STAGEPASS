<?php

namespace App\Http\Controllers;

use App\Models\Auditorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuditorioController extends Controller
{
    public function index()
    {
        $auditorios = Auditorio::all();
        return view('auditorios.index', compact('auditorios'));
    }

    public function create()
    {
        return view('auditorios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:60',
            'estado' => 'required|string|max:30',
            'ciudad' => 'required|string|max:60',
            'direccion' => 'required|string',
            'capacidad' => 'nullable|integer',
            'comentarios' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('auditorios', 'public');
        }

        Auditorio::create([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
            'ciudad' => $request->ciudad,
            'direccion' => $request->direccion,
            'capacidad' => $request->capacidad,
            'comentarios' => $request->comentarios,
            'imagen' => $imagenPath,
        ]);

        return redirect()->route('auditorios.index')->with('success', 'Auditorio creado correctamente.');
    }

    public function show($id)
    {
        $auditorio = Auditorio::findOrFail($id);
        return view('auditorios.show', compact('auditorio'));
    }

    public function edit($id)
    {
        $auditorio = Auditorio::findOrFail($id);
        return view('auditorios.edit', compact('auditorio'));
    }

    public function update(Request $request, $id)
    {
        $auditorio = Auditorio::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:60',
            'estado' => 'required|string|max:30',
            'ciudad' => 'required|string|max:60',
            'direccion' => 'required|string',
            'capacidad' => 'nullable|integer',
            'comentarios' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($auditorio->imagen) {
                Storage::disk('public')->delete($auditorio->imagen);
            }
            $imagenPath = $request->file('imagen')->store('auditorios', 'public');
            $auditorio->imagen = $imagenPath;
        }

        $auditorio->nombre = $request->nombre;
        $auditorio->estado = $request->estado;
        $auditorio->ciudad = $request->ciudad;
        $auditorio->direccion = $request->direccion;
        $auditorio->capacidad = $request->capacidad;
        $auditorio->comentarios = $request->comentarios;

        $auditorio->save();

        return redirect()->route('auditorios.index')->with('success', 'Auditorio actualizado correctamente.');
    }

    public function destroy($id)
    {
        $auditorio = Auditorio::findOrFail($id);

        if ($auditorio->imagen) {
            Storage::disk('public')->delete($auditorio->imagen);
        }

        $auditorio->delete();

        return redirect()->route('auditorios.index')->with('success', 'Auditorio eliminado correctamente.');
    }
}
