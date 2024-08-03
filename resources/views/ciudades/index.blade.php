@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Ciudades</h1>
        <a href="{{ route('ciudades.create') }}" class="btn btn-primary">Crear Ciudad</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ciudades as $ciudad)
                    <tr>
                        <td>{{ $ciudad->id }}</td>
                        <td>{{ $ciudad->nombre }}</td>
                        <td>{{ $ciudad->pais->nombre }}</td>
                        <td>
                            <a href="{{ route('ciudades.show', $ciudad->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('ciudades.edit', $ciudad->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('ciudades.destroy', $ciudad->id) }}" method="POST"
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
@endsection
