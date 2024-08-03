@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Editar Ticket</h1>
        <form action="{{ route('tickets.update', $ticket) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ciudad_origen_id">Ciudad Origen:</label>
                <select name="ciudad_origen_id" id="ciudad_origen_id" class="form-control">
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" {{ $ticket->ciudad_origen_id == $ciudad->id ? 'selected' : '' }}>
                            {{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ciudad_destino_id">Ciudad Destino:</label>
                <select name="ciudad_destino_id" id="ciudad_destino_id" class="form-control">
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}"
                            {{ $ticket->ciudad_destino_id == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_salida">Fecha Salida:</label>
                <input type="date" name="fecha_salida" id="fecha_salida" class="form-control"
                    value="{{ $ticket->fecha_salida ? \Carbon\Carbon::parse($ticket->fecha_salida)->format('Y-m-d') : '' }}">
            </div>
            <div class="form-group">
                <label for="fecha_regreso">Fecha Llegada:</label>
                <input type="date" name="fecha_regreso" id="fecha_regreso" class="form-control"
                    value="{{ $ticket->fecha_regreso ? \Carbon\Carbon::parse($ticket->fecha_regreso)->format('Y-m-d') : '' }}">
            </div>
            <div class="form-group">
                <label for="nombre_completo">Nombre Completo:</label>
                <input type="text" name="nombre_completo" id="nombre_completo" class="form-control"
                    value="{{ $ticket->nombre_completo }}">
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ $ticket->correo }}">
            </div>
            <div class="form-group">
                <label for="celular">Teléfono Celular:</label>
                <input type="text" name="celular" id="celular" class="form-control" value="{{ $ticket->celular }}">
            </div>
            <div class="form-group">
                <label for="codigo_unico">Código Único:</label>
                <input type="text" name="codigo_unico" id="codigo_unico" class="form-control"
                    value="{{ $ticket->codigo_unico }}">
            </div>
            <div class="form-group">
                <label for="categoria_id">Categoría:</label>
                <select name="categoria_id" id="categoria_id" class="form-control">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ $ticket->categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Ticket</button>
        </form>
    </div>
@endsection
