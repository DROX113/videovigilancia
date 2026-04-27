@extends('layouts.plantilla')

@section('contenido')
<h4 class="fw-bold mb-4">
    <i class="bi bi-speedometer2 me-2 text-info"></i>Dashboard
</h4>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #0f3460, #1a6dff);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-1 fw-bold">{{ $totalCamaras }}</div>
                    <div class="opacity-75">Cámaras</div>
                </div>
                <i class="bi bi-camera-video fs-1 opacity-50"></i>
            </div>
            <div class="card-footer border-0 bg-transparent">
                <a href="{{ route('camaras.index') }}" class="text-white text-decoration-none small">
                    Ver todas <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #1a472a, #2ecc71);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-1 fw-bold">{{ $totalEventos }}</div>
                    <div class="opacity-75">Eventos</div>
                </div>
                <i class="bi bi-calendar-event fs-1 opacity-50"></i>
            </div>
            <div class="card-footer border-0 bg-transparent">
                <a href="{{ route('eventos.index') }}" class="text-white text-decoration-none small">
                    Ver todos <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #7b2d00, #e74c3c);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-1 fw-bold">{{ $alertasPendientes }}</div>
                    <div class="opacity-75">Alertas Pendientes</div>
                </div>
                <i class="bi bi-bell fs-1 opacity-50"></i>
            </div>
            <div class="card-footer border-0 bg-transparent">
                <a href="{{ route('alertas.index') }}" class="text-white text-decoration-none small">
                    Ver todas <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #2c003e, #9b59b6);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-1 fw-bold">{{ $totalUsuarios }}</div>
                    <div class="opacity-75">Usuarios</div>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
            <div class="card-footer border-0 bg-transparent">
                <a href="{{ route('usuarios.index') }}" class="text-white text-decoration-none small">
                    Ver todos <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Últimos eventos --}}
<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-clock-history me-2"></i> Últimos 5 Eventos
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Cámara</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosEventos as $evento)
                        <tr>
                            <td>{{ $evento->camara->nombre ?? 'N/A' }}</td>
                            <td><span class="badge bg-secondary text-capitalize">{{ $evento->tipo }}</span></td>
                            <td class="small">{{ \Carbon\Carbon::parse($evento->fecha_hora)->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Sin eventos aún.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-bell me-2"></i> Últimas 5 Alertas
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Mensaje</th>
                            <th>Nivel</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasAlertas as $alerta)
                        <tr>
                            <td class="small">{{ Str::limit($alerta->mensaje, 30) }}</td>
                            <td>
                                @php
                                    $col = ['baja'=>'success','media'=>'warning','alta'=>'danger','critica'=>'danger'];
                                @endphp
                                <span class="badge bg-{{ $col[$alerta->nivel] ?? 'secondary' }} text-capitalize">
                                    {{ $alerta->nivel }}
                                </span>
                            </td>
                            <td>
                                @if($alerta->estado == 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($alerta->estado == 'atendida')
                                    <span class="badge bg-success">Atendida</span>
                                @else
                                    <span class="badge bg-secondary">Descartada</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Sin alertas aún.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection