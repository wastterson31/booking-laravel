@extends('admin.welcome')

@section('content')
    <div class="container">
        <h1>Detalles de Ciudad</h1>
        <p><strong>ID:</strong> {{ $ciudad->id }}</p>
        <p><strong>Nombre:</strong> {{ $ciudad->nombre }}</p>
        <p><strong>País:</strong> {{ $ciudad->pais->nombre }}</p>
        <a href="{{ route('ciudades.index') }}" class="btn btn-primary">Volver</a>
    </div>
@endsection
