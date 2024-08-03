@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Editar Ciudad</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('ciudades.update', $ciudad->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $ciudad->nombre }}"
                    required>
            </div>
            <div class="form-group">
                <label for="pais_id">País</label>
                <select name="pais_id" id="pais_id" class="form-control" required>
                    @foreach ($paises as $pais)
                        <option value="{{ $pais->id }}" {{ $ciudad->pais_id == $pais->id ? 'selected' : '' }}>
                            {{ $pais->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
