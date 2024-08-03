<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Viajes\Viaje;

class VueloController extends Controller
{
    public function buscarVuelos(Request $request)
    {
        $ciudadDestino = $request->input('ciudad_destino');


        $ciudad = Ciudad::where('nombre', 'like', '%' . $ciudadDestino . '%')->first();

        if (!$ciudad) {
            return response()->json([]);
        }


        $vuelos = Viaje::where('ciudad_destino_id', $ciudad->id)
            ->with('ciudadOrigen', 'ciudadDestino')
            ->get();


        $data = $vuelos->map(function ($vuelo) {
            return [
                'ciudad_origen' => $vuelo->ciudadOrigen->nombre,
                'ciudad_destino' => $vuelo->ciudadDestino->nombre,
                'hora_salida' => $vuelo->hora_salida,
                'hora_llegada' => $vuelo->hora_llegada,
            ];
        });

        return response()->json($data);
    }
}
