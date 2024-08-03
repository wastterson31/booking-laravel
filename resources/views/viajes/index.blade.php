@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Viajes</h1>


        <a href="{{ route('viajes.create') }}" class="btn btn-primary">Crear Viaje</a>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ciudad Origen</th>
                    <th>Ciudad Destino</th>
                    <th>Hora Salida</th>
                    <th>Hora Llegada</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viajes as $viaje)
                    <tr>
                        <td>{{ $viaje->id }}</td>
                        <td>{{ $viaje->ciudadOrigen->nombre }}</td>
                        <td>{{ $viaje->ciudadDestino->nombre }}</td>
                        <td>{{ $viaje->hora_salida }}</td>
                        <td>{{ $viaje->hora_llegada }}</td>
                        <td>{{ $viaje->costo }}</td>
                        <td>
                            <a href="{{ route('viajes.show', $viaje->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('viajes.edit', $viaje->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('viajes.destroy', $viaje->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Scripts específicos de DataTables -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Scripts específicos de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "language": {
                    "lengthMenu": "Mostrar " +
                        `<select class="custom-select custom-select--contr-control-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>` +
                        " registros por página",
                    "zeroRecords": "No hay registros",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "processing": "Procesando...",
                    "buttons": {
                        "copy": "Copiar",
                        "print": "Imprimir",
                        "colvis": "Ocultar columnas"
                    }
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
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
