@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tarjetas de Crédito</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tarjeta_credito.create') }}" class="btn btn-primary mb-3">Agregar nueva tarjeta</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Número enmascarado</th>
                <th>Nombre del titular</th>
                <th>Vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tarjetas as $tarjeta)
            <tr>
                <td>{{ $tarjeta->usuario->name ?? 'N/A' }}</td>
                <td>{{ $tarjeta->numero_enmascarado ?? 'N/D' }}</td>
                <td>{{ $tarjeta->nombre_titular ?? 'N/D' }}</td>
                <td>{{ $tarjeta->vencimiento ? \Carbon\Carbon::parse($tarjeta->vencimiento)->format('m/Y') : 'N/D' }}</td>
                <td>
                    <a href="{{ route('tarjeta_credito.edit', $tarjeta->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('tarjeta_credito.destroy', $tarjeta->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta tarjeta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
