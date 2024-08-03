<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;

class CancelacionVueloController extends Controller
{
    public function filtrar(Request $request)
    {
        $codigoBoleto = $request->codigo_boleto;

        $ticket = Ticket::where('codigo_unico', $codigoBoleto)
            ->with('ciudadOrigen', 'ciudadDestino', 'viaje')
            ->first();

        if ($ticket) {
            return response()->json($ticket);
        } else {
            return response()->json(['error' => 'Ticket no encontrado'], 404);
        }
    }

    public function cancelar(Request $request)
    {
        $codigoBoleto = $request->codigo_boleto;

        $ticket = Ticket::where('codigo_unico', $codigoBoleto)->first();

        if ($ticket) {
            // $costoCancelacion = $ticket->viaje->costo * 0.1;

            $ticket->delete();

            return response()->json(['message' => 'Ticket cancelado exitosamente']);
        } else {
            return response()->json(['error' => 'Ticket no encontrado'], 404);
        }
    }
}
