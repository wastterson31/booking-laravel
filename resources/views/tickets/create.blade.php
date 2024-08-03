@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Crear Ticket</h1>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ciudad_origen_id">Ciudad Origen:</label>
                <select name="ciudad_origen_id" id="ciudad_origen_id" class="form-control">
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ciudad_destino_id">Ciudad Destino:</label>
                <select name="ciudad_destino_id" id="ciudad_destino_id" class="form-control">
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_salida">Fecha Salida:</label>
                <input type="date" name="fecha_salida" id="fecha_salida" class="form-control">
            </div>
            <div class="form-group">
                <label for="fecha_regreso">Fecha Regreso:</label>
                <input type="date" name="fecha_regreso" id="fecha_regreso" class="form-control">
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control">
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" name="celular" id="celular" class="form-control">
            </div>
            <div class="form-group">
                <label for="nombre_completo">Nombre Completo:</label>
                <input type="text" name="nombre_completo" id="nombre_completo" class="form-control">
            </div>
            <div class="form-group">
                <label for="numero_identificacion">Número Identificación:</label>
                <input type="text" name="numero_identificacion" id="numero_identificacion" class="form-control">
            </div>
            <div class="form-group">
                <label for="codigo_unico">Código Único:</label>
                <input type="text" name="codigo_unico" id="codigo_unico" class="form-control">
            </div>
            <div class="form-group">
                <label for="categoria_id">Categoría:</label>
                <select name="categoria_id" id="categoria_id" class="form-control">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear Ticket</button>
        </form>
    </div>
@endsection
