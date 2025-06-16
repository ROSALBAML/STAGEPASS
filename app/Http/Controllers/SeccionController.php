<?php
namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\Auditorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeccionController extends Controller
{
    public function index()
    {
        $secciones = Seccion::with('auditorio')->get();
        return view('secciones.index', compact('secciones'));
    }

    public function create()
    {
        $auditorios = Auditorio::all();
        return view('secciones.create', compact('auditorios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'auditorio_id' => 'required|exists:auditorios,id',
            'nombre_seccion' => 'required|string|max:60',
            'precio' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('secciones', 'public');
        }

        Seccion::create([
            'auditorio_id' => $request->auditorio_id,
            'nombre_seccion' => $request->nombre_seccion,
            'precio' => $request->precio,
            'observaciones' => $request->observaciones,
            'imagen' => $imagenPath,
        ]);

        return redirect()->route('secciones.index')->with('success', 'Sección creada correctamente.');
    }

    public function show($id)
    {
        $seccion = Seccion::with('auditorio')->findOrFail($id);
        return view('secciones.show', compact('seccion'));
    }

    public function edit($id)
    {
        $seccion = Seccion::findOrFail($id);
        $auditorios = Auditorio::all();
        return view('secciones.edit', compact('seccion', 'auditorios'));
    }

    public function update(Request $request, $id)
    {
        $seccion = Seccion::findOrFail($id);

        $request->validate([
            'auditorio_id' => 'required|exists:auditorios,id',
            'nombre_seccion' => 'required|string|max:60',
            'precio' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($seccion->imagen) {
                Storage::disk('public')->delete($seccion->imagen);
            }
            $imagenPath = $request->file('imagen')->store('secciones', 'public');
            $seccion->imagen = $imagenPath;
        }

        $seccion->auditorio_id = $request->auditorio_id;
        $seccion->nombre_seccion = $request->nombre_seccion;
        $seccion->precio = $request->precio;
        $seccion->observaciones = $request->observaciones;

        $seccion->save();

        return redirect()->route('secciones.index')->with('success', 'Sección actualizada correctamente.');
    }

    public function destroy($id)
    {
        $seccion = Seccion::findOrFail($id);
        if ($seccion->imagen) {
            Storage::disk('public')->delete($seccion->imagen);
        }
        $seccion->delete();

        return redirect()->route('secciones.index')->with('success', 'Sección eliminada correctamente.');
    }
}
