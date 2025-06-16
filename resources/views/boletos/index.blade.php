@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Boletos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('boletos.create') }}" class="btn btn-primary mb-3">Crear nuevo boleto</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Sección</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($boletos as $boleto)
                <tr>
                    <td>{{ $boleto->evento->nombre ?? 'N/A' }}</td>
                    <td>{{ $boleto->seccion->nombre ?? 'N/A' }}</td>
                    <td>${{ number_format($boleto->precio_unitario, 2) }}</td>
                    <td>{{ $boleto->estado }}</td>
                    <td>
                        <a href="{{ route('boletos.show', $boleto->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('boletos.edit', $boleto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('boletos.destroy', $boleto->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Seguro que deseas eliminar este boleto?')" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
