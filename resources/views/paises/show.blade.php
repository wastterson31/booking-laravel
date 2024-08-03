@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Detalles del País</h1>
        <p><strong>ID:</strong> {{ $pais->id }}</p>
        <p><strong>Nombre:</strong> {{ $pais->nombre }}</p>
        <p><strong>Código ISO:</strong> {{ $pais->codigo_iso }}</p>
        <a href="{{ route('paises.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
@endsection
