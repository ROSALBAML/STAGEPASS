<?php
namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\User;
use App\Models\TarjetaCredito;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with(['comprador', 'tarjetaCredito'])->get();
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $usuarios = User::all();
        $tarjetas = TarjetaCredito::all();
        return view('compras.create', compact('usuarios', 'tarjetas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comprador_id' => 'required|exists:users,id',
            'tarjeta_credito_id' => 'nullable|exists:tarjeta_credito,id',
            'total' => 'required|numeric|min:0',
        ]);

        Compra::create($request->all());

        return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente.');
    }

    public function show($id)
    {
        $compra = Compra::with(['comprador', 'tarjetaCredito'])->findOrFail($id);
        return view('compras.show', compact('compra'));
    }

    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $usuarios = User::all();
        $tarjetas = TarjetaCredito::all();
        return view('compras.edit', compact('compra', 'usuarios', 'tarjetas'));
    }

    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);

        $request->validate([
            'comprador_id' => 'required|exists:users,id',
            'tarjeta_credito_id' => 'nullable|exists:tarjeta_credito,id',
            'total' => 'required|numeric|min:0',
        ]);

        $compra->update($request->all());

        return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente.');
    }

    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->delete();

        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente.');
    }
}
