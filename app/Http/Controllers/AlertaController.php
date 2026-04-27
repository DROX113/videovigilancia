<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Evento;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function index()
    {
        $alertas = Alerta::with(['evento.camara', 'usuario'])
            ->orderBy('id', 'desc')->get();
        return view('alertas.index', compact('alertas'));
    }

    public function create()
    {
        $eventos  = Evento::with('camara')->orderBy('id', 'desc')->get();
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('alertas.create', compact('eventos', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'evento_id'  => 'required|exists:eventos,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'nivel'      => 'required|in:baja,media,alta,critica',
            'estado'     => 'required|in:pendiente,atendida,descartada',
            'mensaje'    => 'required|string',
        ], [
            'evento_id.required'  => 'Selecciona un evento.',
            'evento_id.exists'    => 'El evento seleccionado no existe.',
            'usuario_id.required' => 'Selecciona un usuario.',
            'usuario_id.exists'   => 'El usuario seleccionado no existe.',
            'nivel.required'      => 'El nivel es obligatorio.',
            'estado.required'     => 'El estado es obligatorio.',
            'mensaje.required'    => 'El mensaje es obligatorio.',
        ]);

        Alerta::create($request->all());

        return redirect()->route('alertas.index')
            ->with('success', 'Alerta registrada correctamente.');
    }

    public function show($id)
    {
        $alerta = Alerta::with(['evento.camara', 'usuario'])->findOrFail($id);
        return view('alertas.show', compact('alerta'));
    }

    public function edit($id)
    {
        $alerta   = Alerta::findOrFail($id);
        $eventos  = Evento::with('camara')->orderBy('id', 'desc')->get();
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('alertas.edit', compact('alerta', 'eventos', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'evento_id'  => 'required|exists:eventos,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'nivel'      => 'required|in:baja,media,alta,critica',
            'estado'     => 'required|in:pendiente,atendida,descartada',
            'mensaje'    => 'required|string',
        ], [
            'evento_id.required'  => 'Selecciona un evento.',
            'usuario_id.required' => 'Selecciona un usuario.',
            'nivel.required'      => 'El nivel es obligatorio.',
            'estado.required'     => 'El estado es obligatorio.',
            'mensaje.required'    => 'El mensaje es obligatorio.',
        ]);

        $alerta = Alerta::findOrFail($id);
        $alerta->update($request->all());

        return redirect()->route('alertas.index')
            ->with('success', 'Alerta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $alerta = Alerta::findOrFail($id);
        $alerta->delete();

        return redirect()->route('alertas.index')
            ->with('success', 'Alerta eliminada correctamente.');
    }
}