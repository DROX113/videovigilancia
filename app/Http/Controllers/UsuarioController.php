<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id', 'desc')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8',
            'rol'      => 'required|in:admin,operador,visualizador',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nombre.required'   => 'El nombre es obligatorio.',
            'email.required'    => 'El email es obligatorio.',
            'email.unique'      => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
            'rol.required'      => 'El rol es obligatorio.',
            'foto.image'        => 'El archivo debe ser una imagen.',
            'foto.mimes'        => 'La imagen debe ser jpeg, png, jpg o gif.',
            'foto.max'          => 'La imagen no debe pesar más de 2MB.',
        ]);

        $datos = [
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => $request->rol,
        ];

        if ($request->hasFile('foto')) {
            $datos['foto'] = $request->file('foto')->store('usuarios', 'public');
        }

        Usuario::create($datos);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email,' . $id,
            'password' => 'nullable|string|min:8',
            'rol'      => 'required|in:admin,operador,visualizador',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required'  => 'El email es obligatorio.',
            'email.unique'    => 'Este email ya está en uso por otro usuario.',
            'password.min'    => 'La contraseña debe tener al menos 8 caracteres.',
            'rol.required'    => 'El rol es obligatorio.',
            'foto.image'      => 'El archivo debe ser una imagen.',
            'foto.mimes'      => 'La imagen debe ser jpeg, png, jpg o gif.',
            'foto.max'        => 'La imagen no debe pesar más de 2MB.',
        ]);

        $usuario = Usuario::findOrFail($id);

        $datos = [
            'nombre' => $request->nombre,
            'email'  => $request->email,
            'rol'    => $request->rol,
        ];

        if ($request->filled('password')) {
            $datos['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            // Elimina la foto anterior si existe
            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }
            $datos['foto'] = $request->file('foto')->store('usuarios', 'public');
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        // Elimina la foto del storage al borrar el usuario
        if ($usuario->foto) {
            Storage::disk('public')->delete($usuario->foto);
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}