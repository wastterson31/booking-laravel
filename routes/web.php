<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\TickesCrudController;
use App\Http\Controllers\Ticket\TicketController;
use App\Http\Controllers\CancelacionVueloController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');

Route::get('/buscar-vuelos', [VueloController::class, 'buscarVuelos'])->name('buscar.vuelos');


Route::get('/filtrar-vuelo', [CancelacionVueloController::class, 'filtrar'])->name('filtrar.vuelo');
Route::get('/cancelar-vuelo', [CancelacionVueloController::class, 'cancelar'])->name('cancelar.vuelo');


//rutas administrador
Route::get('/admin', [Controller::class, 'index']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para verificar la disponibilidad de la categoría
Route::get('/categoria/check-availability', [TicketController::class, 'checkCategoryAvailability'])->name('categoria.checkAvailability');


Route::middleware(['auth'])->group(function () {
    // Rutas de viajes
    Route::get('/viajes/create', [ViajeController::class, 'create'])->name('viajes.create');
    Route::post('/viajes', [ViajeController::class, 'store'])->name('viajes.store');
    Route::get('/viajes/{viaje}', [ViajeController::class, 'show'])->name('viajes.show');
    Route::get('/viajes/{viaje}/edit', [ViajeController::class, 'edit'])->name('viajes.edit');
    Route::put('/viajes/{viaje}', [ViajeController::class, 'update'])->name('viajes.update');
    Route::delete('/viajes/{viaje}', [ViajeController::class, 'destroy'])->name('viajes.destroy');
    Route::get('/viajes', [ViajeController::class, 'index'])->name('viajes.index');

    //rutas de la tabla ciudades

    Route::get('/ciudades', [CiudadController::class, 'index'])->name('ciudades.index');
    Route::get('/ciudades/create', [CiudadController::class, 'create'])->name('ciudades.create');
    Route::post('/ciudades', [CiudadController::class, 'store'])->name('ciudades.store');
    Route::get('/ciudades/{ciudad}', [CiudadController::class, 'show'])->name('ciudades.show');
    Route::get('/ciudades/{ciudad}/edit', [CiudadController::class, 'edit'])->name('ciudades.edit');
    Route::put('/ciudades/{ciudad}', [CiudadController::class, 'update'])->name('ciudades.update');
    Route::delete('/ciudades/{ciudad}', [CiudadController::class, 'destroy'])->name('ciudades.destroy');

    // ruta para país
    // Rutas para el CRUD de Países
    Route::get('/paises', [PaisController::class, 'index'])->name('paises.index');
    Route::get('/paises/create', [PaisController::class, 'create'])->name('paises.create');
    Route::post('/paises', [PaisController::class, 'store'])->name('paises.store');
    Route::get('/paises/{pais}', [PaisController::class, 'show'])->name('paises.show');
    Route::get('/paises/{pais}/edit', [PaisController::class, 'edit'])->name('paises.edit');
    Route::put('/paises/{pais}', [PaisController::class, 'update'])->name('paises.update');
    Route::delete('/paises/{pais}', [PaisController::class, 'destroy'])->name('paises.destroy');

    //rutas para la tabla tickets

    Route::get('/tickets', [TickesCrudController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TickesCrudController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TickesCrudController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TickesCrudController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/edit', [TickesCrudController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [TickesCrudController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [TickesCrudController::class, 'destroy'])->name('tickets.destroy');
});



//Rutas de la api de prueba que estoy consumiendo desde un archivo de python

Route::get('/api-resource', [ApiController::class, 'getResource']);
Route::post('/api-resource', [ApiController::class, 'createResource']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
