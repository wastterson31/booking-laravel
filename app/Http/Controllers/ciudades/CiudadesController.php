<?php

namespace App\Http\Controllers\Ciudades;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use App\Models\Ciudades\Pais;
use App\Http\Controllers\Controller;

class CiudadesController extends Controller
{
    public function index()
    {

        $ciudades = Ciudad::all();
        // dd($ciudades);

        return view('home', ['ciudades' => $ciudades]);
    }

    public function show($id)
    {

        $ciudad = Ciudad::findOrFail($id);


        $ciudades = Ciudad::all();


        return view('home', ['ciudad' => $ciudad, 'ciudades' => $ciudades]);
    }
}
