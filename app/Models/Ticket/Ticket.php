<?php

// app/Models/Ticket/Ticket.php

namespace App\Models\Ticket;

use App\Models\Ciudad;
use App\Models\Viajes\Viaje;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'ciudad_origen_id',
        'ciudad_destino_id',
        'fecha_salida',
        'fecha_regreso',
        'correo',
        'celular',
        'nombre_completo',
        'numero_identificacion',
        'codigo_unico',
        'categoria_id',
    ];

    public function ciudadOrigen()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_origen_id');
    }

    public function ciudadDestino()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_destino_id');
    }

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
