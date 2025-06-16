@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Categoría</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="creado_por_admin" class="form-label">Creado por</label>
            <select name="creado_por_admin" id="creado_por_admin" class="form-select">
                <option value="">-- Seleccione un administrador --</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->usuario_id }}" {{ $categoria->creado_por_admin == $admin->usuario_id ? 'selected' : '' }}>
                        {{ $admin->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
