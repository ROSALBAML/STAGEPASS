<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use App\Models\Admin;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    public function index()
    {
        $subcategorias = Subcategoria::with(['categoria', 'admin'])->get();
        return view('subcategorias.index', compact('subcategorias'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $admins = Admin::all();
        return view('subcategorias.create', compact('categorias', 'admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:30',
            'creado_por_admin' => 'nullable|exists:admins,usuario_id',
        ]);

        Subcategoria::create($request->all());

        return redirect()->route('subcategorias.index')->with('success', 'Subcategoría creada correctamente.');
    }

    public function edit($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $categorias = Categoria::all();
        $admins = Admin::all();
        return view('subcategorias.edit', compact('subcategoria', 'categorias', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:30',
            'creado_por_admin' => 'nullable|exists:admins,usuario_id',
        ]);

        $subcategoria->update($request->all());

        return redirect()->route('subcategorias.index')->with('success', 'Subcategoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->delete();

        return redirect()->route('subcategorias.index')->with('success', 'Subcategoría eliminada correctamente.');
    }
}
