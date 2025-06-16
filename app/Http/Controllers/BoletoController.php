<?php
namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Evento;
use App\Models\Seccion;
use Illuminate\Http\Request;

class BoletoController extends Controller
{
    public function index()
    {
        $boletos = Boleto::with(['evento', 'seccion'])->get();
        return view('boletos.index', compact('boletos'));
    }

    public function create()
    {
        $eventos = Evento::all();
        $secciones = Seccion::all();
        return view('boletos.create', compact('eventos', 'secciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'seccion_id' => 'required|exists:secciones,id',
            'precio_unitario' => 'required|numeric|min:0',
            'estado' => 'required|string|max:20',
        ]);

        Boleto::create($request->all());

        return redirect()->route('boletos.index')->with('success', 'Boleto creado correctamente.');
    }

    public function show($id)
    {
        $boleto = Boleto::with(['evento', 'seccion'])->findOrFail($id);
        return view('boletos.show', compact('boleto'));
    }

    public function edit($id)
    {
        $boleto = Boleto::findOrFail($id);
        $eventos = Evento::all();
        $secciones = Seccion::all();
        return view('boletos.edit', compact('boleto', 'eventos', 'secciones'));
    }

    public function update(Request $request, $id)
    {
        $boleto = Boleto::findOrFail($id);

        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'seccion_id' => 'required|exists:secciones,id',
            'precio_unitario' => 'required|numeric|min:0',
            'estado' => 'required|string|max:20',
        ]);

        $boleto->update($request->all());

        return redirect()->route('boletos.index')->with('success', 'Boleto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $boleto = Boleto::findOrFail($id);
        $boleto->delete();

        return redirect()->route('boletos.index')->with('success', 'Boleto eliminado correctamente.');
    }
}
