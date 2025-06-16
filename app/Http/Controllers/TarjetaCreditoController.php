<?php

namespace App\Http\Controllers;

use App\Models\TarjetaCredito;
use App\Models\User;
use Illuminate\Http\Request;

class TarjetaCreditoController extends Controller
{
    public function index()
    {
        $tarjetas = TarjetaCredito::all();
        return view('tarjeta_credito.index', compact('tarjetas'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('tarjeta_credito.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'numero_enmascarado' => 'nullable|string|max:20',
            'token_seguro' => 'nullable|string|max:30',
            'nombre_titular' => 'nullable|string|max:90',
            'vencimiento' => 'nullable|date',
        ]);

        TarjetaCredito::create($request->all());

        return redirect()->route('tarjeta_credito.index')->with('success', 'Tarjeta creada correctamente.');
    }

    public function edit($id)
    {
        $tarjeta = TarjetaCredito::findOrFail($id);
        $usuarios = User::all();
        return view('tarjeta_credito.edit', compact('tarjeta', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $tarjeta = TarjetaCredito::findOrFail($id);

        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'numero_enmascarado' => 'nullable|string|max:20',
            'token_seguro' => 'nullable|string|max:30',
            'nombre_titular' => 'nullable|string|max:90',
            'vencimiento' => 'nullable|date',
        ]);

        $tarjeta->update($request->all());

        return redirect()->route('tarjeta_credito.index')->with('success', 'Tarjeta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $tarjeta = TarjetaCredito::findOrFail($id);
        $tarjeta->delete();

        return redirect()->route('tarjeta_credito.index')->with('success', 'Tarjeta eliminada correctamente.');
    }
}
