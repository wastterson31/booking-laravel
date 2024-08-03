<?php

// app/Models/Categoria.php

namespace App\Models;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cantidad_pasajeros',
        'capacidad_total',
        'asientos_ocupados',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
