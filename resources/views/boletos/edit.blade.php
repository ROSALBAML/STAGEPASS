@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Boleto</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('boletos.update', $boleto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="evento_id" class="form-label">Evento</label>
            <select name="evento_id" class="form-select" required>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}" {{ $boleto->evento_id == $evento->id ? 'selected' : '' }}>
                        {{ $evento->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="seccion_id" class="form-label">Sección</label>
            <select name="seccion_id" class="form-select" required>
                @foreach($secciones as $seccion)
                    <option value="{{ $seccion->id }}" {{ $boleto->seccion_id == $seccion->id ? 'selected' : '' }}>
                        {{ $seccion->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" name="precio_unitario" class="form-control" value="{{ $boleto->precio_unitario }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{ $boleto->estado }}" maxlength="20" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('boletos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
