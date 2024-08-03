<?php

namespace App\Models;

use App\Models\Pais;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';

    protected $fillable = [
        'nombre',
        'pais_id',
    ];


    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }
}
