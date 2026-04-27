<?php

namespace App\Http\Controllers;

use App\Models\Camara;
use App\Models\Evento;
use App\Models\Alerta;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCamaras     = Camara::count();
        $totalEventos     = Evento::count();
        $alertasPendientes = Alerta::where('estado', 'pendiente')->count();
        $totalUsuarios    = Usuario::count();

        $ultimosEventos = Evento::with('camara')
            ->orderBy('id', 'desc')->take(5)->get();

        $ultimasAlertas = Alerta::orderBy('id', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalCamaras',
            'totalEventos',
            'alertasPendientes',
            'totalUsuarios',
            'ultimosEventos',
            'ultimasAlertas'
        ));
    }
}