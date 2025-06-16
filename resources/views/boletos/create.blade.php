@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Boleto</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('boletos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="evento_id" class="form-label">Evento</label>
            <select name="evento_id" class="form-select" required>
                <option value="">-- Seleccione un evento --</option>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}">{{ $evento->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="seccion_id" class="form-label">Sección</label>
            <select name="seccion_id" class="form-select" required>
                <option value="">-- Seleccione una sección --</option>
                @foreach($secciones as $seccion)
                    <option value="{{ $seccion->id }}">{{ $seccion->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" name="precio_unitario" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control" maxlength="20" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('boletos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
