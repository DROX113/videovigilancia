@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('alertas.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-dark text-white">
        <i class="bi bi-bell me-2"></i> Detalle de Alerta
    </div>
    <div class="card-body">
        <table class="table table-bordered mb-0">
            <tr><th style="width:35%">ID</th><td>{{ $alerta->id }}</td></tr>
            <tr><th>Evento</th><td>#{{ $alerta->evento->id ?? 'N/A' }} — {{ $alerta->evento->tipo ?? '' }}</td></tr>
            <tr><th>Usuario notificado</th><td>{{ $alerta->usuario->nombre ?? 'N/A' }}</td></tr>
            <tr><th>Nivel</th><td><span class="badge bg-danger text-capitalize">{{ $alerta->nivel }}</span></td></tr>
            <tr><th>Estado</th><td>
                @if($alerta->estado == 'pendiente')
                    <span class="badge bg-warning text-dark">Pendiente</span>
                @elseif($alerta->estado == 'atendida')
                    <span class="badge bg-success">Atendida</span>
                @else
                    <span class="badge bg-secondary">Descartada</span>
                @endif
            </td></tr>
            <tr><th>Mensaje</th><td>{{ $alerta->mensaje }}</td></tr>
            <tr><th>Registrada</th><td>{{ $alerta->created_at->format('d/m/Y H:i') }}</td></tr>
        </table>
    </div>
</div>
@endsection