<!-- resources/views/tickets/index.blade.php -->
@extends('admin.welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Listado de Tickets</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('tickets.create') }}" class="btn btn-primary">Crear Ticket</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ciudad Origen</th>
                        <th>Ciudad Destino</th>
                        <th>Fecha Salida</th>
                        <th>Categoria</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->ciudadOrigen ? $ticket->ciudadOrigen->nombre : 'Desconocida' }}</td>
                            <td>{{ $ticket->ciudadDestino ? $ticket->ciudadDestino->nombre : 'Desconocida' }}</td>
                            <td>{{ $ticket->fecha_salida }}</td>
                            <td>{{ $ticket->categoria ? $ticket->categoria->nombre : 'Desconocida' }}</td>
                            <td>{{ $ticket->nombre_completo }}</td>
                            <!-- Mostrar la categoría -->
                            <td>
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este ticket?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
