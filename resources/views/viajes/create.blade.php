<!-- resources/views/viajes/create.blade.php -->

@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Crear Viaje</h1>
        <form action="{{ route('viajes.store') }}" method="POST" id="form-submit">
            @csrf
            <div class="form-group">
                <label for="ciudad_origen_id">Ciudad Origen</label>
                <select name="ciudad_origen_id" id="ciudad_origen_id" class="form-control">
                    <option value="">Selecciona una ciudad...</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ciudad_destino_id">Ciudad Destino</label>
                <select name="ciudad_destino_id" id="ciudad_destino_id" class="form-control">
                    <option value="">Selecciona una ciudad...</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="hora_salida">Fecha Salida</label>
                <input type="date" name="hora_salida" id="hora_salida" class="form-control">
            </div>
            <div class="form-group">
                <label for="hora_llegada">Fecha Llegada</label>
                <input type="date" name="hora_llegada" id="hora_llegada" class="form-control">
            </div>
            <div class="form-group">
                <label for="costo">Costo</label>
                <input type="number" name="costo" id="costo" class="form-control" step="0.01">
            </div>
            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select name="categoria_id" id="categoria_id" class="form-control">
                    <option value="">Selecciona una categoría...</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('viajes.index') }}" class="btn btn-primary">Volver</a>
        </form>
    </div>
@endsection

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
        });
    </script>
@endif

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const ciudadOrigenSelect = document.getElementById('ciudad_origen_id');
        const ciudadDestinoSelect = document.getElementById('ciudad_destino_id');
        const todasCiudades = @json($ciudades);

        function actualizarCiudadesDestino(excluirCiudadId) {
            ciudadDestinoSelect.innerHTML = '<option value="">Selecciona una ciudad...</option>';
            todasCiudades.forEach(function(ciudad) {
                if (ciudad.id != excluirCiudadId) {
                    const option = document.createElement('option');
                    option.value = ciudad.id;
                    option.textContent = ciudad.nombre;
                    ciudadDestinoSelect.appendChild(option);
                }
            });
        }

        ciudadOrigenSelect.addEventListener('change', function() {
            const selectedCiudadOrigenId = ciudadOrigenSelect.value;
            actualizarCiudadesDestino(selectedCiudadOrigenId);
        });
    });
</script>
