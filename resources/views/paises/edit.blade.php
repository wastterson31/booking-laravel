@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Editar País</h1>
        <form action="{{ route('paises.update', $pais) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $pais->nombre }}">
            </div>
            <div class="form-group">
                <label for="codigo_iso">Código ISO:</label>
                <input type="text" name="codigo_iso" id="codigo_iso" class="form-control"
                    value="{{ $pais->codigo_iso }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar País</button>
        </form>

    </div>
@endsection
