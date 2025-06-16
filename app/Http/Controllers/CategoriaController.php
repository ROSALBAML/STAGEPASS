<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Admin;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('admin')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        $admins = Admin::all();
        return view('categorias.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:60|unique:categorias,nombre',
            'creado_por_admin' => 'nullable|exists:admins,usuario_id',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        $admins = Admin::all();
        return view('categorias.edit', compact('categoria', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:60|unique:categorias,nombre,' . $categoria->id,
            'creado_por_admin' => 'nullable|exists:admins,usuario_id',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
