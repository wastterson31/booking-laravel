@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Detalle del Viaje</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $viaje->id }}</h5>
                <p class="card-text">Ciudad Origen: {{ $viaje->ciudadOrigen->nombre }}</p>
                <p class="card-text">Ciudad Destino: {{ $viaje->ciudadDestino->nombre }}</p>
                <p class="card-text">Hora Salida: {{ $viaje->hora_salida }}</p>
                <p class="card-text">Hora Llegada: {{ $viaje->hora_llegada }}</p>
                <p class="card-text">Costo: {{ $viaje->costo }}</p>
                <a href="{{ route('viajes.index') }}" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
@endsection
