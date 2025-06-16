@if(isset($eventos) && $eventos->count() > 0)
    <!-- Carrusel -->
    <div id="carruselEventos" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($eventos as $index => $evento)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ $evento->imagen ? asset('storage/'.$evento->imagen) : 'https://via.placeholder.com/1200x400' }}" 
                         class="d-block w-100" 
                         alt="{{ $evento->nombre }}">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50">
                        <h5>{{ $evento->nombre }}</h5>
                        <p>{{ Str::limit($evento->descripcion, 100) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Controles del carrusel -->
    </div>

    <!-- Tarjetas -->
    <div class="row">
        @foreach($eventos as $evento)
            <!-- Tu código de tarjetas aquí -->
        @endforeach
    </div>
@else
    <div class="alert alert-info">No hay eventos disponibles</div>
@endif