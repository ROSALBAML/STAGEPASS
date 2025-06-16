@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Evento</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Evento</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $evento->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $evento->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $evento->fecha) }}" required>
        </div>

        <div class="mb-3">
            <label for="auditorio_id" class="form-label">Auditorio</label>
            <select name="auditorio_id" class="form-select" required>
                @foreach($auditorios as $a)
                    <option value="{{ $a->id }}" {{ $evento->auditorio_id == $a->id ? 'selected' : '' }}>{{ $a->nombre }}</option>
                @endforeach
            </select>
        </div>

        @if($evento->imagen)
            <div class="mb-3">
                <label class="form-label">Imagen actual:</label><br>
                <img src="{{ asset('storage/' . $evento->imagen) }}" width="120">
            </div>
        @endif

        <div class="mb-3">
            <label for="imagen" class="form-label">Nueva imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
