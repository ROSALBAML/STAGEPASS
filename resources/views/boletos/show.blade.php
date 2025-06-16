@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Boleto</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Evento: {{ $boleto->evento->nombre ?? 'N/A' }}</h5>
            <p class="card-text"><strong>Sección:</strong> {{ $boleto->seccion->nombre ?? 'N/A' }}</p>
            <p class="card-text"><strong>Precio:</strong> ${{ number_format($boleto->precio_unitario, 2) }}</p>
            <p class="card-text"><strong>Estado:</strong> {{ $boleto->estado }}</p>
        </div>
    </div>

    <a href="{{ route('boletos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
