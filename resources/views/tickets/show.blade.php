<!-- resources/views/tickets/show.blade.php -->
@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Detalles del Ticket</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>Ciudad Origen:</strong> {{ $ticket->ciudadOrigen->nombre }}</p>
                <p><strong>Ciudad Destino:</strong> {{ $ticket->ciudadDestino->nombre }}</p>
                <p><strong>Fecha Salida:</strong> {{ $ticket->fecha_salida }}</p>
                <p><strong>Nombre del Titular:</strong> {{ $ticket->nombre_completo }}</p>
                <p><strong>Teléfono Celular:</strong> {{ $ticket->celular }}</p>
                <p><strong>Correo Electrónico:</strong> {{ $ticket->correo }}</p>
                <p><strong>Código Único:</strong> {{ $ticket->codigo_unico }}</p>
                <p><strong>Categoría:</strong> {{ $ticket->categoria ? $ticket->categoria->nombre : 'Desconocida' }}</p>
            </div>
        </div>
        <a href="{{ route('tickets.index') }}" class="btn btn-primary mt-3">Volver al listado</a>
    </div>
@endsection
