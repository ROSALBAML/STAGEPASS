<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with('usuario')->get();
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('admins.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id|unique:admins,usuario_id',
            'puede_crear_promotores' => 'boolean',
            'puede_crear_categorias' => 'boolean',
            'puede_crear_subcategorias' => 'boolean',
            'puede_cambiar_estado_evento' => 'boolean',
        ]);

        Admin::create($request->all());

        return redirect()->route('admins.index')->with('success', 'Admin creado correctamente.');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'puede_crear_promotores' => 'boolean',
            'puede_crear_categorias' => 'boolean',
            'puede_crear_subcategorias' => 'boolean',
            'puede_cambiar_estado_evento' => 'boolean',
        ]);

        $admin->update($request->all());

        return redirect()->route('admins.index')->with('success', 'Admin actualizado correctamente.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Admin eliminado correctamente.');
    }
}
