<?php

namespace App\Http\Controllers;

use App\Models\Promotor;
use App\Models\User;
use Illuminate\Http\Request;

class PromotorController extends Controller
{
    public function index()
    {
        $promotores = Promotor::all();
        return view('promotores.index', compact('promotores'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('promotores.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|unique:promotores,usuario_id|exists:users,id',
            'empresa' => 'nullable|string|max:100',
            'rfc' => 'nullable|string|max:13',
            'pagina_web' => 'nullable|string|max:255',
        ]);

        Promotor::create($request->all());

        return redirect()->route('promotores.index')->with('success', 'Promotor creado correctamente.');
    }

    public function edit($id)
    {
        $promotor = Promotor::findOrFail($id);
        $usuarios = User::all();
        return view('promotores.edit', compact('promotor', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $promotor = Promotor::findOrFail($id);

        $request->validate([
            'usuario_id' => 'required|exists:users,id|unique:promotores,usuario_id,' . $promotor->id,
            'empresa' => 'nullable|string|max:100',
            'rfc' => 'nullable|string|max:13',
            'pagina_web' => 'nullable|string|max:255',
        ]);

        $promotor->update($request->all());

        return redirect()->route('promotores.index')->with('success', 'Promotor actualizado correctamente.');
    }

    public function destroy($id)
    {
        $promotor = Promotor::findOrFail($id);
        $promotor->delete();

        return redirect()->route('promotores.index')->with('success', 'Promotor eliminado correctamente.');
    }
}
