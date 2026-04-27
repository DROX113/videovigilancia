@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('camaras.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-dark text-white">
        <i class="bi bi-camera-video me-2"></i> Detalle de Cámara
    </div>
    <div class="card-body">
        <table class="table table-bordered mb-0">
            <tr><th style="width:35%">ID</th><td>{{ $camara->id }}</td></tr>
            <tr><th>Nombre</th><td>{{ $camara->nombre }}</td></tr>
            <tr><th>Ubicación</th><td>{{ $camara->ubicacion }}</td></tr>
            <tr><th>IP</th><td><code>{{ $camara->ip }}</code></td></tr>
            <tr><th>Estado</th><td>
                @if($camara->estado == 'activa')
                    <span class="badge bg-success">Activa</span>
                @elseif($camara->estado == 'inactiva')
                    <span class="badge bg-secondary">Inactiva</span>
                @else
                    <span class="badge bg-danger">Falla</span>
                @endif
            </td></tr>
            <tr><th>Registrada</th><td>{{ $camara->created_at->format('d/m/Y H:i') }}</td></tr>
        </table>
    </div>
</div>
@endsection