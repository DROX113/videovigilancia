@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('eventos.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-dark text-white">
        <i class="bi bi-calendar-event me-2"></i> Detalle del Evento
    </div>
    <div class="card-body">
        <table class="table table-bordered mb-0">
            <tr><th style="width:35%">ID</th><td>{{ $evento->id }}</td></tr>
            <tr><th>Cámara</th><td>{{ $evento->camara->nombre ?? 'N/A' }}</td></tr>
            <tr><th>Registrado por</th><td>{{ $evento->usuario->nombre ?? 'N/A' }}</td></tr>
            <tr><th>Tipo</th><td><span class="badge bg-secondary text-capitalize">{{ $evento->tipo }}</span></td></tr>
            <tr><th>Descripción</th><td>{{ $evento->descripcion }}</td></tr>
            <tr><th>Fecha y Hora</th><td>{{ \Carbon\Carbon::parse($evento->fecha_hora)->format('d/m/Y H:i') }}</td></tr>
            <tr><th>Registrado</th><td>{{ $evento->created_at->format('d/m/Y H:i') }}</td></tr>
        </table>
    </div>
</div>
@endsection