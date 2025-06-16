@extends('layouts.app')

@section('content')
    <h2>Editar Promotor</h2>

    <form action="{{ route('promotores.update', $promotor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Usuario:</label>
        <select name="usuario_id" required>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ $usuario->id == $promotor->usuario_id ? 'selected' : '' }}>{{ $usuario->name }}</option>
            @endforeach
        </select>

        <label>Empresa:</label>
        <input type="text" name="empresa" value="{{ $promotor->empresa }}">

        <label>RFC:</label>
        <input type="text" name="rfc" value="{{ $promotor->rfc }}">

        <label>Página Web:</label>
        <input type="text" name="pagina_web" value="{{ $promotor->pagina_web }}">

        <button type="submit">Actualizar</button>
    </form>
@endsection
