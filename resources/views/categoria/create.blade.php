@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Categoría</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="creado_por_admin" class="form-label">Creado por</label>
            <select name="creado_por_admin" id="creado_por_admin" class="form-select">
                <option value="">-- Seleccione un administrador --</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->usuario_id }}">{{ $admin->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
