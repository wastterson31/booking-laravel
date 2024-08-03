<?php

namespace App\Http\Controllers;

use App\Models\Viajes\Viaje;
use App\Models\Ciudad;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    public function index()
    {
        $viajes = Viaje::with(['ciudadOrigen', 'ciudadDestino'])->get();
        return view('viajes.index', compact('viajes'));
    }

    public function create()
    {
        $ciudades = Ciudad::all();
        return view('viajes.create', compact('ciudades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ciudad_origen_id' => 'required|exists:ciudades,id',
            'ciudad_destino_id' => 'required|exists:ciudades,id',
            'hora_salida' => 'required|date',
            'hora_llegada' => 'required|date',
            'costo' => 'required|numeric',
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
        return view('viajes.edit', compact('viaje', 'ciudades'));
    }

    public function update(Request $request, Viaje $viaje)
    {
        // dd($request->all());
        $request->validate([
            'ciudad_origen_id' => 'required|exists:ciudades,id',
            'ciudad_destino_id' => 'required|exists:ciudades,id',
            'hora_salida' => 'required|date',
            'hora_llegada' => 'required|date',
            'costo' => 'required|numeric',
        ]);

        $viaje->update([
            'ciudad_origen_id' => $request->ciudad_origen_id,
            'ciudad_destino_id' => $request->ciudad_destino_id,
            'hora_salida' => $request->hora_salida,
            'hora_llegada' => $request->hora_llegada,
            'costo' => $request->costo,
            'costo_id' => null,
        ]);

        return redirect()->route('viajes.index')->with('success', 'Viaje actualizado exitosamente.');
    }


    public function destroy(Viaje $viaje)
    {
        $viaje->delete();
        return redirect()->route('viajes.index')->with('success', 'Viaje eliminado exitosamente.');
    }
}
