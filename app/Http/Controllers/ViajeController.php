<?php

namespace App\Http\Controllers;

use App\Models\Viajes\Viaje;
use App\Models\Ciudad;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    public function index()
    {
        $viajes = Viaje::with(['ciudadOrigen', 'ciudadDestino', 'categoria'])->get();
        return view('viajes.index', compact('viajes'));
    }


    public function create()
    {
        $ciudades = Ciudad::all();
        $categorias = Categoria::all(); // Nuevas categorías
        return view('viajes.create', compact('ciudades', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ciudad_origen_id' => 'required|exists:ciudades,id',
            'ciudad_destino_id' => 'required|exists:ciudades,id',
            'hora_salida' => 'required|date',
            'hora_llegada' => 'required|date',
            'costo' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id', // Nueva validación
        ]);

        Viaje::create($request->all());

        return redirect()->route('viajes.index')->with('success', 'Viaje creado exitosamente.');
    }

    public function show(Viaje $viaje)
    {
        return view('viajes.show', compact('viaje'));
    }

    public function edit(Viaje $viaje)
    {
        $ciudades = Ciudad::all();
        $categorias = Categoria::all(); // Nuevas categorías
        return view('viajes.edit', compact('viaje', 'ciudades', 'categorias'));
    }

    public function update(Request $request, Viaje $viaje)
    {
        $request->validate([
            'ciudad_origen_id' => 'required|exists:ciudades,id',
            'ciudad_destino_id' => 'required|exists:ciudades,id',
            'hora_salida' => 'required|date',
            'hora_llegada' => 'required|date',
            'costo' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id', // Nueva validación
        ]);

        $viaje->update($request->all());

        return redirect()->route('viajes.index')->with('success', 'Viaje actualizado exitosamente.');
    }

    public function destroy(Viaje $viaje)
    {
        $viaje->delete();
        return redirect()->route('viajes.index')->with('success', 'Viaje eliminado exitosamente.');
    }
}
