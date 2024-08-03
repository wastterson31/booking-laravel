<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Categoria;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class TickesCrudController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['ciudadOrigen', 'ciudadDestino', 'categoria'])->get();
        return view('tickets.index', compact('tickets'));
    }


    public function create()
    {
        $ciudades = Ciudad::all();
        $categorias = Categoria::all();

        return view('tickets.create', compact('ciudades', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ciudad_origen_id' => 'required',
            'ciudad_destino_id' => 'required',
            'fecha_salida' => 'required|date',
            'fecha_regreso' => 'required|date',
            'correo' => 'required|email',
            'celular' => 'required',
            'nombre_completo' => 'required',
            'numero_identificacion' => 'required',
            'categoria_id' => 'required',
        ]);

        Ticket::create($request->all());

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket creado correctamente.');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $ciudades = Ciudad::all();
        $categorias = Categoria::all();

        return view('tickets.edit', compact('ticket', 'ciudades', 'categorias'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'ciudad_origen_id' => 'required',
            'ciudad_destino_id' => 'required',
            'fecha_salida' => 'required|date',
            'fecha_regreso' => 'required|date',
            'correo' => 'required|email',
            'celular' => 'required',
            'nombre_completo' => 'required',
            'numero_identificacion' => 'required',
            'categoria_id' => 'required',
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket actualizado correctamente.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket eliminado correctamente.');
    }
}
