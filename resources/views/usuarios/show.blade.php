@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-dark text-white">
        <i class="bi bi-person me-2"></i> Detalle de Usuario
    </div>
    <div class="card-body text-center pb-2">
        <img src="{{ $usuario->foto ? asset('storage/' . $usuario->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($usuario->nombre) . '&background=0f3460&color=fff&size=120' }}"
            class="rounded-circle mb-3"
            style="width:120px; height:120px; object-fit:cover; border: 4px solid #0f3460;">
    </div>
    <div class="card-body pt-0">
        <table class="table table-bordered mb-0">
            <tr><th style="width:35%">ID</th><td>{{ $usuario->id }}</td></tr>
            <tr><th>Nombre</th><td>{{ $usuario->nombre }}</td></tr>
            <tr><th>Email</th><td>{{ $usuario->email }}</td></tr>
            <tr><th>Rol</th><td>
                @if($usuario->rol == 'admin')
                    <span class="badge bg-danger">Admin</span>
                @elseif($usuario->rol == 'operador')
                    <span class="badge bg-warning text-dark">Operador</span>
                @else
                    <span class="badge bg-info text-dark">Visualizador</span>
                @endif
            </td></tr>
            <tr><th>Registrado</th><td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td></tr>
        </table>
    </div>
</div>
@endsection