<?php

namespace App\Models\Viajes;

use App\Models\Ciudad;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Viaje extends Model
{
    use HasFactory;
    protected $table = 'viajes';

    protected $fillable = [
        'ciudad_origen_id',
        'ciudad_destino_id',
        'hora_salida',
        'hora_llegada',
        'costo',
        'categoria_id', // Nuevo campo para categoría
    ];

    public function ciudadOrigen()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_origen_id');
    }

    public function ciudadDestino()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_destino_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
