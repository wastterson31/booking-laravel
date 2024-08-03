@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Listado de Países</h1>
        <a href="{{ route('paises.create') }}" class="btn btn-primary mb-2">Crear País</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código ISO</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paises as $pais)
                    <tr>
                        <td>{{ $pais->id }}</td>
                        <td>{{ $pais->nombre }}</td>
                        <td>{{ $pais->codigo_iso }}</td>
                        <td>
                            <a href="{{ route('paises.show', $pais->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('paises.edit', $pais->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('paises.destroy', $pais->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este país?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
