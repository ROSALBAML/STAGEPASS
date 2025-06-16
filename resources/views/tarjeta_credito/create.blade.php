@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Tarjeta de Crédito</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('tarjeta_credito.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario</label>
            <select name="usuario_id" class="form-select" required>
                <option value="">-- Selecciona un usuario --</option>
                @foreach($usuarios as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="numero_enmascarado" class="form-label">Número enmascarado</label>
            <input type="text" name="numero_enmascarado" class="form-control" maxlength="20">
        </div>

        <div class="mb-3">
            <label for="token_seguro" class="form-label">Token seguro</label>
            <input type="text" name="token_seguro" class="form-control" maxlength="30">
        </div>

        <div class="mb-3">
            <label for="nombre_titular" class="form-label">Nombre del titular</label>
            <input type="text" name="nombre_titular" class="form-control" maxlength="90">
        </div>

        <div class="mb-3">
            <label for="vencimiento" class="form-label">Fecha de vencimiento</label>
            <input type="date" name="vencimiento" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('tarjeta_credito.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
