<?php

namespace App\Http\Controllers\Ticket;

use App\Models\Categoria;
use App\Models\Ciudad;
use App\Models\Viajes\Viaje;
use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'ciudad_origen_id' => 'required|exists:ciudades,id',
            'ciudad_destino_id' => 'required|exists:ciudades,id',
            'fecha_salida' => 'required|date',
            'correo' => 'required|email',
            'celular' => 'nullable|string',
            'nombre_completo' => 'nullable|string',
            'numero_identificacion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar si hay un viaje disponible
        $viajeDisponible = Viaje::where('ciudad_origen_id', $request->ciudad_origen_id)
            ->where('ciudad_destino_id', $request->ciudad_destino_id)
            ->where('hora_salida', '>=', $request->fecha_salida)
            ->orderBy('hora_salida')
            ->first();

        if (!$viajeDisponible) {
            return response()->json(['error' => 'No hay viajes disponibles para esta ruta en la fecha seleccionada'], 404);
        }

        // Verificar disponibilidad de la categoría
        $categoria = Categoria::find($request->categoria_id);

        if (!$categoria) {
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }

        if ($categoria->asientos_ocupados >= $categoria->cantidad_pasajeros) {
            return response()->json(['error' => 'No hay asientos disponibles en esta categoría'], 400);
        }

        // Generar un código único
        $codigoUnico = uniqid();

        // Crear el ticket
        $ticketData = [
            'ciudad_origen_id' => $request->ciudad_origen_id,
            'ciudad_destino_id' => $request->ciudad_destino_id,
            'fecha_salida' => $request->fecha_salida,
            'correo' => $request->correo,
            'celular' => $request->celular,
            'viaje_id' => $viajeDisponible->id,
            'nombre_completo' => $request->nombre_completo,
            'numero_identificacion' => $request->numero_identificacion,
            'codigo_unico' => $codigoUnico,
            'categoria_id' => $request->categoria_id,
        ];

        // Crear el ticket
        $ticket = Ticket::create($ticketData);

        // Actualizar los asientos ocupados
        $categoria->increment('asientos_ocupados');

        // Enviar el código único por correo
        $this->enviarCodigoUnicoPorCorreo($codigoUnico, $ticket->correo, $ticketData);

        $message = [
            'title' => '¡Ticket Creado!',
            'text' => 'El ticket se ha creado correctamente. Se ha enviado un correo electrónico con el código único.',
            'icon' => 'success',
        ];

        return response()->json(['ticket' => $ticket, 'message' => $message], 201);
    }

    public function enviarCodigoUnicoPorCorreo($codigoUnico, $correoDestinatario, $ticketData)
    {
        $ciudadOrigen = Ciudad::find($ticketData['ciudad_origen_id'])->nombre;
        $ciudadDestino = Ciudad::find($ticketData['ciudad_destino_id'])->nombre;
        $categoria = Categoria::find($ticketData['categoria_id'])->nombre;

        $subject = '¡Bienvenido a Tus viajes seguros!';
        $mailContent = [
            'mail_1' => "Aquí está tu código único para tu ticket: $codigoUnico. Recuerda que con este código puedes hacer la cancelación o mirar tu viaje en la plataforma.",
            'mail_2' => 'Recuerda que si quieres cancelar el viaje lo puedes hacer a través de este link: colocaellinK, ten en cuenta que tendrá un costo del 10% del costo de tu boleto.',
            'mail_3' => '¡Que tengas un excelente viaje con nosotros!',
        ];

        Mail::send([], compact('mailContent', 'subject', 'ticketData', 'ciudadOrigen', 'ciudadDestino', 'categoria'), function ($message) use ($correoDestinatario, $subject, $mailContent, $ticketData, $ciudadOrigen, $ciudadDestino, $categoria) {
            $message->to($correoDestinatario)
                ->subject($subject)
                ->setBody("
                    <h2>$subject</h2>
                    <p>{$mailContent['mail_1']}</p>
                    <p>{$mailContent['mail_2']}</p>
                    <p>{$mailContent['mail_3']}</p>
                    <hr>
                    <p>Información adicional:</p>
                    <ul>
                        <li>Ciudad de origen: {$ciudadOrigen}</li>
                        <li>Ciudad de destino: {$ciudadDestino}</li>
                        <li>Fecha de salida: {$ticketData['fecha_salida']}</li>
                        <li>Nombre completo: {$ticketData['nombre_completo']}</li>
                        <li>Número de identificación: {$ticketData['numero_identificacion']}</li>
                        <li>Categoría: {$categoria}</li>
                    </ul>
                ", 'text/html');
        });
    }

    public function buscarVuelo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_unico' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket = Ticket::where('codigo_unico', $request->codigo_unico)->first();

        if (!$ticket) {
            return response()->json(['error' => 'No se encontró ningún vuelo con el código único proporcionado'], 404);
        }

        return response()->json($ticket);
    }

    public function cancelarVuelo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_unico' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket = Ticket::where('codigo_unico', $request->codigo_unico)->first();

        if (!$ticket) {
            return response()->json(['error' => 'No se encontró ningún vuelo con el código único proporcionado'], 404);
        }

        return response()->json($ticket);
    }

    public function confirmarCancelacion(Request $request)
    {
        return response()->json(['message' => 'Cancelación confirmada exitosamente']);
    }

    // Método para verificar disponibilidad de la categoría
    public function checkCategoryAvailability(Request $request)
    {
        $categoriaId = $request->input('categoria_id');

        // Buscar la categoría
        $categoria = Categoria::find($categoriaId);

        if ($categoria) {
            $puestosDisponibles = $categoria->cantidad_pasajeros - $categoria->asientos_ocupados;

            return response()->json([
                'success' => true,
                'puestosDisponibles' => $puestosDisponibles
            ]);
        }

        return response()->json(['success' => false], 404);
    }
}
