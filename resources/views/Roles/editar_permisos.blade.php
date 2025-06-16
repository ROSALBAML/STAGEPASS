@extends('layouts.app')

@section('content')
    <h1>Asignar permisos al rol: {{ $rol->nombre }}</h1>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('roles.permisos.update', $rol->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            @foreach ($permisos as $permiso)
                <label>
                    <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}"
                        {{ in_array($permiso->id, $permisosAsignados) ? 'checked' : '' }}>
                    {{ $permiso->nombre }}
                </label><br>
            @endforeach
        </div>

        <button type="submit">Guardar permisos</button>
        <a href="{{ route('roles.index') }}">Cancelar</a>
    </form>
@endsection
