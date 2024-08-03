@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Editar Viaje</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('viajes.update', $viaje->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ciudad_origen_id">Ciudad Origen</label>
                <select name="ciudad_origen_id" id="ciudad_origen_id" class="form-control">
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" {{ $ciudad->id == $viaje->ciudad_origen_id ? 'selected' : '' }}>
                            {{ $ciudad->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ciudad_destino_id">Ciudad Destino</label>
                <select name="ciudad_destino_id" id="ciudad_destino_id" class="form-control">
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}"
                            {{ $ciudad->id == $viaje->ciudad_destino_id ? 'selected' : '' }}>
                            {{ $ciudad->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="hora_salida">Fecha Salida</label>
                <input type="date" name="hora_salida" id="hora_salida" class="form-control"
                    value="{{ $viaje->hora_salida ? \Carbon\Carbon::parse($viaje->hora_salida)->format('Y-m-d') : '' }}">
            </div>
            <div class="form-group">
                <label for="hora_llegada">Fecha Llegada</label>
                <input type="date" name="hora_llegada" id="hora_llegada" class="form-control"
                    value="{{ $viaje->hora_llegada ? \Carbon\Carbon::parse($viaje->hora_llegada)->format('Y-m-d') : '' }}">
            </div>
            <div class="form-group">
                <label for="costo">Costo</label>
                <input type="number" name="costo" id="costo" class="form-control" step="0.01"
                    value="{{ $viaje->costo }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

    {{-- @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif --}}
@endsection

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const ciudadOrigenSelect = document.getElementById('ciudad_origen_id');
        const ciudadDestinoSelect = document.getElementById('ciudad_destino_id');
        const todasCiudades =
            @json($ciudades);

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

        ciudadDestinoSelect.addEventListener('change', function() {
            const selectedCiudadDestinoId = ciudadDestinoSelect.value;
            actualizarCiudadesOrigen(selectedCiudadDestinoId);
        });
    });
</script>
