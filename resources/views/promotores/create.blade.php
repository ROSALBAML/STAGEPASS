@extends('layouts.app')

@section('content')
    <h2>Crear Promotor</h2>

    <form action="{{ route('promotores.store') }}" method="POST">
        @csrf
        <label>Usuario:</label>
        <select name="usuario_id" required>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
            @endforeach
        </select>

        <label>Empresa:</label>
        <input type="text" name="empresa">

        <label>RFC:</label>
        <input type="text" name="rfc">

        <label>Página Web:</label>
        <input type="text" name="pagina_web">

        <button type="submit">Guardar</button>
    </form>
@endsection
