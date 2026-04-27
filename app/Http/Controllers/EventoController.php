<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Camara;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with(['camara', 'usuario'])
            ->orderBy('id', 'desc')->get();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        $camaras  = Camara::where('estado', 'activa')->get();
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('eventos.create', compact('camaras', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'camara_id'   => 'required|exists:camaras,id',
            'usuario_id'  => 'required|exists:usuarios,id',
            'tipo'        => 'required|in:movimiento,intrusion,sabotaje,otro',
            'descripcion' => 'required|string',
            'fecha_hora'  => 'required|date',
        ], [
            'camara_id.required'   => 'Selecciona una cámara.',
            'camara_id.exists'     => 'La cámara seleccionada no existe.',
            'usuario_id.required'  => 'Selecciona un usuario.',
            'usuario_id.exists'    => 'El usuario seleccionado no existe.',
            'tipo.required'        => 'El tipo de evento es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'fecha_hora.required'  => 'La fecha y hora son obligatorias.',
            'fecha_hora.date'      => 'El formato de fecha no es válido.',
        ]);

        Evento::create($request->all());

        return redirect()->route('eventos.index')
            ->with('success', 'Evento registrado correctamente.');
    }

    public function show($id)
    {
        $evento = Evento::with(['camara', 'usuario'])->findOrFail($id);
        return view('eventos.show', compact('evento'));
    }

    public function edit($id)
    {
        $evento   = Evento::findOrFail($id);
        $camaras  = Camara::where('estado', 'activa')->get();
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('eventos.edit', compact('evento', 'camaras', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'camara_id'   => 'required|exists:camaras,id',
            'usuario_id'  => 'required|exists:usuarios,id',
            'tipo'        => 'required|in:movimiento,intrusion,sabotaje,otro',
            'descripcion' => 'required|string',
            'fecha_hora'  => 'required|date',
        ], [
            'camara_id.required'   => 'Selecciona una cámara.',
            'usuario_id.required'  => 'Selecciona un usuario.',
            'tipo.required'        => 'El tipo de evento es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'fecha_hora.required'  => 'La fecha y hora son obligatorias.',
        ]);

        $evento = Evento::findOrFail($id);
        $evento->update($request->all());

        return redirect()->route('eventos.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
}