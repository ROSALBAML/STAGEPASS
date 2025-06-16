@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <!-- Carrusel -->
    <div id="carruselEventos" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($eventos as $index => $evento)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ $evento->imagen ?? 'https://via.placeholder.com/1200x400' }}" class="d-block w-100" alt="{{ $evento->nombre }}">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50">
                        <h5>{{ $evento->nombre }}</h5>
                        <p>{{ $evento->descripcion }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carruselEventos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carruselEventos" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Tarjetas -->
    <div class="row">
        @foreach($eventos as $evento)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $evento->imagen ?? 'https://via.placeholder.com/400x200' }}" class="card-img-top" alt="{{ $evento->nombre }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nombre }}</h5>
                        <p class="card-text">{{ Str::limit($evento->descripcion, 100) }}</p>
                        <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
