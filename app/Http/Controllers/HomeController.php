<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ciudades = Ciudad::all();
        $categorias = Categoria::all();

        return view('home', ['ciudades' => $ciudades, 'categorias' => $categorias]);
    }

    public function show($id)
    {
        $ciudad = Ciudad::findOrFail($id);
        $ciudades = Ciudad::all();
        $categorias = Categoria::all();

        return view('home', ['ciudad' => $ciudad, 'ciudades' => $ciudades, 'categorias' => $categorias]);
    }
}
