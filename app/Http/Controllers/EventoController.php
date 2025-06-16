<?php
namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Auditorio;
use App\Models\Categoria; // Importación añadida
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Muestra la página principal pública
     */
    public function welcome()
    {
        $eventos = Evento::with('organizador', 'auditorio')->get();
        $categorias = Categoria::with('subcategorias')->get();
        return view('welcome', compact('eventos', 'categorias'));
    }

    /**
     * Muestra el listado de eventos (vista admin)
     */
    public function index()
    {
       $eventos = Evento::with('organizador', 'auditorio')->get();
       return view('eventos.index', compact('eventos'));
    }

    /**
     * Muestra el formulario de creación
     */
    public function create()
    {
        $auditorios = Auditorio::all();
        return view('eventos.create', compact('auditorios'));
    }

    /**
     * Almacena un nuevo evento
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'auditorio_id' => 'required|exists:auditorios,id',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('eventos', 'public');
        }

        $validated['organizador_id'] = Auth::id();

        Evento::create($validated);

        return redirect()->route('eventos.index')->with('success', 'Evento creado correctamente.');
    }

    /**
     * Muestra un evento específico
     */
    public function show($id)
    {
        $evento = Evento::with('organizador', 'auditorio')->findOrFail($id);
        return view('eventos.show', compact('evento'));
    }

    /**
     * Muestra el formulario de edición
     */
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        $auditorios = Auditorio::all();
        return view('eventos.edit', compact('evento', 'auditorios'));
    }

    /**
     * Actualiza un evento existente
     */
    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'auditorio_id' => 'required|exists:auditorios,id',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($evento->imagen) {
                Storage::disk('public')->delete($evento->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->update($validated);

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    /**
     * Elimina un evento
     */
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        
        if ($evento->imagen) {
            Storage::disk('public')->delete($evento->imagen);
        }
        
        $evento->delete();

        return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
    
}