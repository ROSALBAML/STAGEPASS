@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subcategorías</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('subcategorias.create') }}" class="btn btn-primary mb-3">Crear nueva subcategoría</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Creado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategorias as $subcategoria)
                <tr>
                    <td>{{ $subcategoria->nombre }}</td>
                    <td>{{ $subcategoria->categoria->nombre ?? 'N/A' }}</td>
                    <td>{{ $subcategoria->admin->nombre ?? 'Sin asignar' }}</td>
                    <td>
                        <a href="{{ route('subcategorias.edit', $subcategoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('subcategorias.destroy', $subcategoria->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Seguro que deseas eliminar esta subcategoría?')" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
