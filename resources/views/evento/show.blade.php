@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Evento</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $evento->nombre }}</h5>
            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
            <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
            <p><strong>Auditorio:</strong> {{ $evento->auditorio->nombre ?? 'N/A' }}</p>
            <p><strong>Organizador:</strong> {{ $evento->organizador->name ?? 'N/A' }}</p>
            @if($evento->imagen)
                <p><strong>Imagen:</strong><br>
                    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen del evento" width="200">
                </p>
            @endif
        </div>
    </div>

    <a href="{{ route('eventos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
