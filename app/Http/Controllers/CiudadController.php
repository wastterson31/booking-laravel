<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function index()
    {
        $ciudades = Ciudad::all();
        return view('ciudades.index', compact('ciudades'));
    }

    public function create()
    {
        $paises = Pais::all();

        return view('ciudades.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:ciudades,nombre',
            'pais_id' => 'required|exists:paises,id',
        ], [
            'nombre.unique' => 'La ciudad con este nombre ya existe.',
        ]);

        Ciudad::create([
            'nombre' => $request->nombre,
            'pais_id' => $request->pais_id,
        ]);

        return redirect()->route('ciudades.index')->with('success', 'Ciudad creada exitosamente.');
    }



    public function show(Ciudad $ciudad)
    {
        return view('ciudades.show', compact('ciudad'));
    }

    public function edit($id)

    {
        $ciudad = Ciudad::findOrFail($id);
        $paises = Pais::all();

        return view('ciudades.edit', compact('ciudad', 'paises'));
    }

    public function update(Request $request, Ciudad $ciudad)
    {
        $request->validate([
            'nombre' => 'required|unique:ciudades,nombre',
            'pais_id' => 'required|exists:paises,id',
        ], [
            'nombre.unique' => 'La ciudad con este nombre ya existe.',
        ]);

        $ciudad->update($request->all());

        return redirect()->route('ciudades.index')
            ->with('success', 'Ciudad actualizada exitosamente.');
    }

    public function destroy(Ciudad $ciudad)
    {
        $ciudad->delete();

        return redirect()->route('ciudades.index')
            ->with('success', 'Ciudad eliminada exitosamente.');
    }
}
