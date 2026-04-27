<?php

namespace App\Http\Controllers;

use App\Models\Camara;
use Illuminate\Http\Request;

class CamaraController extends Controller
{
    public function index()
    {
        $camaras = Camara::orderBy('id', 'desc')->get();
        return view('camaras.index', compact('camaras'));
    }

    public function create()
    {
        return view('camaras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'ip'        => 'required|string|unique:camaras,ip',
            'estado'    => 'required|in:activa,inactiva,falla',
        ], [
            'nombre.required'    => 'El nombre es obligatorio.',
            'ubicacion.required' => 'La ubicación es obligatoria.',
            'ip.required'        => 'La dirección IP es obligatoria.',
            'ip.unique'          => 'Esta IP ya está registrada.',
            'estado.required'    => 'El estado es obligatorio.',
        ]);

        Camara::create($request->all());

        return redirect()->route('camaras.index')
            ->with('success', 'Cámara registrada correctamente.');
    }

    public function show($id)
    {
        $camara = Camara::findOrFail($id);
        return view('camaras.show', compact('camara'));
    }

    public function edit($id)
    {
        $camara = Camara::findOrFail($id);
        return view('camaras.edit', compact('camara'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'ip'        => 'required|string|unique:camaras,ip,' . $id,
            'estado'    => 'required|in:activa,inactiva,falla',
        ], [
            'nombre.required'    => 'El nombre es obligatorio.',
            'ubicacion.required' => 'La ubicación es obligatoria.',
            'ip.required'        => 'La dirección IP es obligatoria.',
            'ip.unique'          => 'Esta IP ya está registrada en otra cámara.',
            'estado.required'    => 'El estado es obligatorio.',
        ]);

        $camara = Camara::findOrFail($id);
        $camara->update($request->all());

        return redirect()->route('camaras.index')
            ->with('success', 'Cámara actualizada correctamente.');
    }

    public function destroy($id)
    {
        $camara = Camara::findOrFail($id);
        $camara->delete();

        return redirect()->route('camaras.index')
            ->with('success', 'Cámara eliminada correctamente.');
    }
}