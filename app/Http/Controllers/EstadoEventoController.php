<?php

namespace App\Http\Controllers;

use App\Models\EstadoEvento;
use Illuminate\Http\Request;

class EstadoEventoController extends Controller
{
    public function index()
    {
        $estados = EstadoEvento::all();
        return view('estados_evento.index', compact('estados'));
    }

    public function create()
    {
        return view('estados_evento.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:20|unique:estados_evento,nombre',
        ]);

        EstadoEvento::create($request->all());

        return redirect()->route('estados_evento.index')->with('success', 'Estado creado correctamente.');
    }

    public function edit($id)
    {
        $estado = EstadoEvento::findOrFail($id);
        return view('estados_evento.edit', compact('estado'));
    }

    public function update(Request $request, $id)
    {
        $estado = EstadoEvento::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:20|unique:estados_evento,nombre,'.$id,
        ]);

        $estado->update($request->all());

        return redirect()->route('estados_evento.index')->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy($id)
    {
        $estado = EstadoEvento::findOrFail($id);
        $estado->delete();

        return redirect()->route('estados_evento.index')->with('success', 'Estado eliminado correctamente.');
    }
}
