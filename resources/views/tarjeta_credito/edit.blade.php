@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Tarjeta de Crédito</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('tarjeta_credito.update', $tarjeta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario</label>
            <select name="usuario_id" class="form-select" required>
                @foreach($usuarios as $user)
                    <option value="{{ $user->id }}" {{ $tarjeta->usuario_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="numero_enmascarado" class="form-label">Número enmascarado</label>
            <input type="text" name="numero_enmascarado" class="form-control" maxlength="20" value="{{ old('numero_enmascarado', $tarjeta->numero_enmascarado) }}">
        </div>

        <div class="mb-3">
            <label for="token_seguro" class="form-label">Token seguro</label>
            <input type="text" name="token_seguro" class="form-control" maxlength="30" value="{{ old('token_seguro', $tarjeta->token_seguro) }}">
        </div>

        <div class="mb-3">
            <label for="nombre_titular" class="form-label">Nombre del titular</label>
            <input type="text" name="nombre_titular" class="form-control" maxlength="90" value="{{ old('nombre_titular', $tarjeta->nombre_titular) }}">
        </div>

        <div class="mb-3">
            <label for="vencimiento" class="form-label">Fecha de vencimiento</label>
            <input type="date" name="vencimiento" class="form-control" value="{{ old('vencimiento', $tarjeta->vencimiento) }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tarjeta_credito.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
