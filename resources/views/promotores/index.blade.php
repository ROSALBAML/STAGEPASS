@extends('layouts.app')

@section('content')
    <h2>Lista de Promotores</h2>
    <a href="{{ route('promotores.create') }}">Nuevo Promotor</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Empresa</th>
                <th>RFC</th>
                <th>Página Web</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotores as $promotor)
                <tr>
                    <td>{{ $promotor->id }}</td>
                    <td>{{ $promotor->usuario->name }}</td>
                    <td>{{ $promotor->empresa }}</td>
                    <td>{{ $promotor->rfc }}</td>
                    <td>{{ $promotor->pagina_web }}</td>
                    <td>
                        <a href="{{ route('promotores.edit', $promotor->id) }}">Editar</a>
                        <form action="{{ route('promotores.destroy', $promotor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
