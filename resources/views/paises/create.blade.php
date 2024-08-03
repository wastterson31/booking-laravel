@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Crear País</h1>

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

        <form action="{{ route('paises.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label for="codigo_iso">Código ISO:</label>
                <input type="text" name="codigo_iso" id="codigo_iso" class="form-control" value="{{ old('codigo_iso') }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Crear País</button>
        </form>
    </div>
@endsection
